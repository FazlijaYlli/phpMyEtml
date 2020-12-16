<?php

echo '<h3>Charger des données sur '.$_GET['dbList'].'</h3>
<form action="importing.php?dbList='.$_GET['dbList'].'" method="post" enctype="multipart/form-data">
      <label for="download">Téléverser votre fichier (fichiers .sql seulement) : </label>
        <input type="file" name="download" id="download"/><br>
        
        <input type="submit" name="submit">
        </form>';

$uploaddir = "../../import";
if(!empty($_FILES)) {
    $file = basename($_FILES['download']['name']);

    if (move_uploaded_file($_FILES['download']['tmp_name'], $uploaddir . $file)) {
        echo "UPLOAD REUSSI";
    } else {
        echo "ECHEC DE L'UPLOAD, REESAYEZ";
    }
}
?>