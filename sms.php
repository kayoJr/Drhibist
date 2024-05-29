<?php
// $to ='0923187741';
// $otp = '4875';
// $domain = 'drhibistpedriatician.com';
// $id = '9728';

// $server = 'https://sms.yegara.com/api3/send';
// $postData = array('to' => $to, 'otp' => $otp, 'id' =>$id, 'domain' => $domain );
// $content = json_encode($postData);
// $curl = curl_init($server);
// curl_setopt($curl, CURLOPT_HEADER, false);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
// $json_response = curl_exec($curl);
// $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// curl_close($curl);

// print_r($json_response);



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.chapa.co/v1/transaction/initialize',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
 "amount":"100",
  "currency": "ETB",
  "email": "abebech_bekele@gmail.com",
  "first_name": "Bilen",
  "last_name": "Gizachew",
  "phone_number": "0912345678",
  "tx_ref": "chewatatest-6669",
  "callback_url": "https://webhook.site/077164d6-29cb-40df-ba29-8a00e59a7e60",
  "return_url": "https://www.google.com/",
  "customization[title]": "Payment for my favourite merchant",
  "customization[description]": "I love online payments."
  }',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer CHASECK_TEST-ikwxTCNf8l5QOZcCz8VMNaa9RX2CZwcW',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


?>