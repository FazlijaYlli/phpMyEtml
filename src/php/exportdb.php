<?php
$command = "F:\Logiciels\Wamp\UwAmp\bin\database\mysql-5.7.11\bin\mysqldump --user=root --password=root --host=localhost ".$_GET['dbList']." > C:/users/elivuille/desktop/".$_GET['dbList']."_backup.sql";

$return_var = NULL;
$output = NULL;
exec($command, $output, $return_var);
var_dump($output);
var_dump($return_var);
?>