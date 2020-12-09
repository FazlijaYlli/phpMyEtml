<?php session_start();
if(isset($_SESSION['user'])){
    header("Location:connected.php");
}
else{
    header("Location:accueil.php");
}

?>