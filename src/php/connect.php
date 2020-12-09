<?php session_start();

try {
    $connection = new PDO('mysql:host='. $_POST['radConnect'] .';dbname=mysql;charset=utf8',''.$_POST['user'].'', ''.$_POST['password'].'');
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['address'] = $_POST['radConnect'];
}
catch(PDOException $e){
    $_SESSION['password'] = NULL;
    $_SESSION['user'] = NULL;
    $_SESSION['address'] = NULL;
}

	header("Location:../../index.php");

?>