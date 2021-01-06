<?php
$userprofile = getenv('USERPROFILE');
$command = "F:\Logiciels\Wamp\UwAmp\bin\database\mysql-5.7.11\bin\mysqldump --user=root --password=root --host=localhost ".$_GET['dbList']." > ".$userprofile."/Downloads/".$_GET['dbList']."_backup.sql";


$return_var = NULL;
$output = NULL;
exec($command, $output, $return_var);
header('Location:connected.php');
?>