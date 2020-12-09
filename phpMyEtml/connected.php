<?php
session_start(); ?>
<!DOCTYPE html>
<head>
    <title>PhpMyETML</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <meta charset="utf-8">
</head>
<body>
<nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="#">PhpMyEtml</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Importer une BD</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Exporter une BD</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Importer des données</a>
            </li>
        </ul>
    </div>
</nav>
<main class="container">

    <table class="table table-striped mt-4">
        <thead>
        <tr>
            <th scope="col">Base de donnée</th>
            <th scope="col">Importer des données</th>
            <th scope="col">Exporter la base de donnée</th>
        </tr>
        </thead>
        <tbody>


<?php
include 'database.php';


$connect = new database();

$connect->getDatabases();



foreach($connect->getDatabases() as $results){
    foreach($results as $result)
    {

        echo '<tr>
                <td>'.$result.'</td>
                <td><a href="">Importer...</a> </td>
                <td><a href="">Exporter...</a> </td>
                
             </tr>';

    }

}

?>
        </tbody>
    </table>
    <form action="createDatabase.php" name="newdatabase" enctype="multipart/form-data" method="post">
        <label for="dbname">Nom de la base de données</label>
        <input type="text" name="dbname" id="dbname">
        <br>
        <button type="submit" name="dbnameSubmit" class="btn btn-primary">Créer une donnée</button>

    </form>

</main>
</body>
