<?php
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
    if($adult < $bebe)
        return -1;
    try{
        $bdd = new PDO('mysql:host=localhost:3307;dbname=vole;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e){
        die('Error : '.$e->message);
    }
    
    $result1 = $bdd->prepare('SELECT city_code FROM iata_cities WHERE lower(city_english) = lower(?)  ');
    $result1->execute(array($source));

    $result2 = $bdd->prepare('SELECT city_code FROM iata_cities WHERE lower(city_english) = lower(?)  ');
    $result2->execute(array($destination));
    
    if( ! ($iata_source = $result1->fetch()) || ! ($iata_destination = $result2->fetch()) )
        return -2;
    
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

    $element = array('count'=> $result['meta']['count'],'vole'=>array());
    
    for($i=0;$i<$element['count'];$i++)
    {
        $element['vole'][$i] = array('depart' => $result['data'][$i]['itineraries'][0]['segments'][0]['departure']['at'],
                                    'arrive' => $result['data'][$i]['itineraries'][0]['segments'][0]['departure']['at'],
                                    'price'  => $result['data'][$i]['price']['total']);
    }
    return $element;

}

?>

