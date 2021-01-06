<?php
session_start();
$userprofile = getenv('USERPROFILE');
$command = "F:\Logiciels\Wamp\UwAmp\bin\database\mysql-5.7.11\bin\mysqldump --user=root --password=root --host=localhost ".$_SESSION["user"]."_".$_GET['dbList']." > ".$userprofile."/Downloads/".$_SESSION["user"]."_".$_GET['dbList'].".sql";


$return_var = NULL;
$output = NULL;
exec($command, $output, $return_var);
header('Location:connected.php');
?>