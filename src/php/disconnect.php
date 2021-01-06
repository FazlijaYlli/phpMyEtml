<?php
$_SESSION['password'] = NULL;
$_SESSION['user'] = NULL;
$_SESSION['address'] = NULL;
$_SESSION['logged'] = NULL;
session_destroy();
header("Location: accueil.php");
