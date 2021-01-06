<?php session_start();
include 'lib/Database.php';
$data = new Database();
$data->deleteDataBase($_GET['dbname']);
//header('Location:connected.php');

?>