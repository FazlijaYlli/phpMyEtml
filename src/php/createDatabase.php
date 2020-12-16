<?php session_start();
include 'database.php';
$data = new Database();
$data->createDatabase($_POST['dbname']);
header('Location:connected.php');

?>