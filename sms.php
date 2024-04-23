<?php
$to ='0923187741';
$otp = '4875';
$domain = 'drhibistpedriatician.com';
$id = '9728';

$server = 'https://sms.yegara.com/api3/send';
$postData = array('to' => $to, 'otp' => $otp, 'id' =>$id, 'domain' => $domain );
$content = json_encode($postData);
$curl = curl_init($server);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

print_r($json_response);

?>