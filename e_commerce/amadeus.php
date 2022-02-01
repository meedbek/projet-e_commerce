<?php
function Iisset($var)
{
    if(isset($var))
        return $var;
    return ''; 
}
function access_token()
{
    $url = "https://test.api.amadeus.com/v1/security/oauth2/token";


    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Content-Type: application/x-www-form-urlencoded",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = "grant_type=client_credentials&client_id=VWqLYh9gEFZrleJNj4sXNy9IXqedZu5H&client_secret=UxgioTKsU1GsF7Kq";

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($resp,true);
    
    return $result['access_token'];
}

function search($source, $destination, $date, $adult, $enfant, $bebe,$classe)
{

    try{
        $bdd = new PDO('mysql:host=localhost:3306;dbname=vole;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e){
        die('Error : '.$e->message);
    }
    
    $result1 = $bdd->prepare('SELECT city_code FROM iata_cities WHERE lower(city_english) = lower(?)  ');
    $result1->execute(array($source));

    $result2 = $bdd->prepare('SELECT city_code FROM iata_cities WHERE lower(city_english) = lower(?)  ');
    $result2->execute(array($destination));
    
    if( ! ($iata_source = $result1->fetch()))
        return -2;
    if(! ($iata_destination = $result2->fetch()))
        return -4;
    
    $iata1 = $iata_source['city_code'];
    $iata2 = $iata_destination['city_code'];

    $url = "https://test.api.amadeus.com/v2/shopping/flight-offers?originLocationCode=".$iata1."&destinationLocationCode=".$iata2."&departureDate=".$date."&adults=".$adult."&children=".$enfant."&infants=".$bebe."&travelClass=".$classe."&currencyCode=MAD&max=250";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Authorization: Bearer ".access_token(),
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($resp,true);

    if(isset($result['meta']['count']))
    {
        $element = array('count'=> $result['meta']['count'],'vole'=>array());
    
        for($i=0;$i<$element['count'];$i++)
        {
        $element['vole'][$i] = array('airline' => $result['data'][$i]['itineraries'][0]['segments'][0]['carrierCode'],
                                     'depart' => $result['data'][$i]['itineraries'][0]['segments'][0]['departure']['at'],
                                     'arrive' => $result['data'][$i]['itineraries'][0]['segments'][0]['arrival']['at'],
                                     'price'  => $result['data'][$i]['price']['total']);
        }
        return $element;
    }
    
    return -3;
    
}

function search_hotel($ville, $arrive, $depart, $chambre, $adulte)
{
    
    try{
        $bdd = new PDO('mysql:host=localhost:3306;dbname=vole;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e){
        die('Error : '.$e->message);
    }
    
    $result1 = $bdd->prepare('SELECT city_code FROM iata_cities WHERE lower(city_english) = lower(?)  ');
    $result1->execute(array($ville));

    
    if( ! ($iata_ville = $result1->fetch()) )
        return -2;
    $element = array();
    $N = 0;
    
    do{
        $city = $iata_ville['city_code'];

        $url = "https://test.api.amadeus.com/v2/shopping/hotel-offers?cityCode=".$city."&checkInDate=".$arrive."&checkOutDate=".$depart."&roomQuantity=".$chambre."&adults=".$adulte."&currency=MAD&lang=FR-fr"; 
        //$url = "https://test.api.amadeus.com/v2/shopping/hotel-offers?cityCode=CAS&checkInDate=2021-06-22&checkOutDate=2021-06-25&roomQuantity=1&adults=1&currency=MAD&lang=FR-fr";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Authorization: Bearer ".access_token(),
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        ini_set('max_execution_time', '300');
        $resp = curl_exec($curl);
        curl_close($curl);
        $rs = json_decode($resp,true);
        //var_dump($rs);
        $n = $N;
        if(isset($rs['data'])){
            $N += count($rs['data']);
            for($i=$n;$i<$N;$i++)
            {
                if(isset($rs['data'][$i-$n]['hotel']['description']['text']))
                    $description = $rs['data'][$i-$n]['hotel']['description']['text'];
                else
                    $description = '';
                
                if(isset($rs['data'][$i-$n]['hotel']['rating']))
                    $stars = $rs['data'][$i-$n]['hotel']['rating'];
                else    
                    $stars = 0;
                $element[$i] = array('nom' => Iisset($rs['data'][$i-$n]['hotel']['name']),
                                    'adresse' => Iisset($rs['data'][$i-$n]['hotel']['address']['lines'][0].' '. $rs['data'][$i-$n]['hotel']['address']['cityName']),
                                    'distance' => Iisset($rs['data'][$i-$n]['hotel']['hotelDistance']['distance']),
                                    'stars' =>$stars,
                                    'price'  => Iisset($rs['data'][$i-$n]['offers'][0]['price']['total']),
                                    'currency' => Iisset($rs['data'][$i-$n]['offers'][0]['price']['currency']),
                                    'description' => $description,
                                    'hotelId' => Iisset($rs['data'][$i-$n]['hotel']['hotelId']));
            }
        }
        
    }while($iata_ville = $result1->fetch());
    
    return $element;
}
//var_dump(search('rabat','paris','2021-06-22',1,0,0,'ECONOMY'));
//var_dump(count(search_hotel('london','2021-06-22','2021-06-25',1,1)));

function search_hotels($ville, $arrive, $depart, $chambre, $adulte)
{
    return array(array('nom' => 'Residence Inn by Marriott London Downtown',
    'adresse' => '383 COLBORNE STREET LONDON',
    'distance' => 0.6,
    'stars' => 4,
    'price'  => 130.69,
    'currency' => 'CAD',
    'description' => 'The Residence Inn by Marriott London Downtown hotel is being renovated! Our decorated, roomy suites are much larger than the size of most hotel rooms and our great downtown London Ontario location on Colborne Street at King Street makes quick work of getting where you need to be. We support your work rhythm with the perfect extended stay experience which combines all the comforts of home with our passion for making every guest feel welcome. Enjoy spacious suites with separate living and sleeping areas and fully equipped kitchens. Our fitness centre help you keep to a productive routine and our free wired and wireless high-speed Internet access coupled with ample work areas and our business centre will help you to sustain your ambitious professional pace. At Residence Inn, we believe in openness, freedom and travelling the way you love to live. We are committed to making sure that when you travel here, you dont just feel like a guest – you feel like yourself!' ));
}
?>

