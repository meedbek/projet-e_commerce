<?php

$url = "https://test.api.amadeus.com/v1/shopping/availability/flight-availabilities";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
   "Authorization: Bearer DaWlsb1ICUSAjCKLVCEfH47UKWJp",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
{
  "originDestinations": [
    {
      "id": "1",
      "originLocationCode": "BOS",
      "destinationLocationCode": "MAD",
      "departureDateTime": {
        "date": "2021-06-14",
        "time": "21:15:00"
      }
    }
  ],
  "travelers": [
    {
      "id": "1",
      "travelerType": "ADULT"
    }
  ],
  "sources": [
    "GDS"
  ]
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
$result = json_decode($resp,true);
echo $result['meta']['count'];
//var_dump(json_decode($resp,true));



?>

