<?php session_start();
if(isset($_SESSION['user'])){
    header("Location:src/php/dbList.php");
}
else{
    header("Location:src/php/accueil.php");
}
?>