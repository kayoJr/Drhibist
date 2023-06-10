<?php
$server = "localhost";
$username = "drhibistpedriati_root";
$password = "8T75YLCACKWe5Ep";
$db_name = "drhibistpedriati_drhibist";

$conn = mysqli_connect($server, $username, $password, $db_name);
$con = mysqli_connect($server, $username, $password, $db_name);

if(!$conn){
    echo("error");
}
