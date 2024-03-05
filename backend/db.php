<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "drhibistpedriati_drhibist";

$conn = mysqli_connect($server, $username, $password, $db_name);
$con = mysqli_connect($server, $username, $password, $db_name);

// $url = 'http://drhibistpedriati.com'; //live
$url = 'http://localhost/DrHibist'; //local

if(!$conn){
    echo("error");
}

?>