<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'money_control_php';

$openBD = mysqli_connect($hostname, $username, $password, $database)
or die('ERROR CONNECTION TO DB');