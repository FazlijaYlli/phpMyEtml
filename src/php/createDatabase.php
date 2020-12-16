<?php session_start();
include 'lib/Database.php';
$data = new Database();
$data->createDatabase($_POST['dbname']);
header('Location:connected.php');

?>