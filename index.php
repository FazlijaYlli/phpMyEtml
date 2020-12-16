<?php session_start();
if(isset($_SESSION['user'])){
    header("Location:src/php/connected.php");
}
else{
    header("Location:src/php/accueil.php");
}

?>