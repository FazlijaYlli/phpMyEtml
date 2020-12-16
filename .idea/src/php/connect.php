<?php session_start();

include 'lib/Database.php';
$data = new Database();
$name = $data->verifUser($_POST['user'],  $_POST['password']);
var_dump($name);
$_SESSION['user'] = Null;
foreach ($name as  $value) {
    $_SESSION['user'] = $value['eleUsername'];
}

header("Location:../../index.php");

?>