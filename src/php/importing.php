<?php
session_start();
var_dump($_GET);

$con = new PDO('mysql:host=localhost;dbname='.$_GET['dbList'].';charset=utf8' , 'root', 'root');
$filename = $_FILES['download']['tmp_name'];
$templine = '';
$lines = file($filename);
foreach($lines as $line){
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

    $templine .= $line;

    if (substr(trim($line), -1, 1) == ';') {
        $con->query($templine);
        $templine = '';
    }

}
header('Location:connected.php');
?>