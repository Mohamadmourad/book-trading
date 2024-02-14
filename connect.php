<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "booktrading";
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
