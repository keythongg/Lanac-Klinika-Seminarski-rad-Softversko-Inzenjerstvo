<?php

$dbhost = "localhost";
$dbuser = "user";
$dbpass = "password";
$dbname = "klinikabosna";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
