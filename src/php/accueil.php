<?php session_start();?>
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
    <a class="navbar-brand" href="#">phpMyEtml</a>
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

<div class="container">
    <h1>Se connecter</h1>
    <form method="post" action="connect.php" enctype="multipart/form-data" name="form">
        <div class="form-group">
            <label for="user">Utilisateur : </label>
            <input type="text" class="form-control" id="user" name="user">
        </div>
        <div class="form-group">
            <label for="pass">Mot de passe</label>
            <input type="password" class="form-control" id="pass" name="password">
        </div>
        <div class="formHide">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radConnect" id="radConnect1" value="localhost" data-toggle="collapse" data-parent="#accordion"data-target=".collapseOne.show" >
                <label class="form-check-label" for="radConnect1">
                    Connexion en local
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radConnect" id="radConnect2" value="2" data-toggle="collapse" data-parent="#accordion" data-target=".collapseOne:not(.show)">
                <label class="form-check-label" for="radConnect2">
                    Connexion à distance
                </label>
            </div>

            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-collapse collapse collapseOne in">
                        <div class="panel-body">
                            <label for="address">Adresse IP du serveur distant :</label>
                            <input type="text" name="ipaddress" id="address">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>


    </form>

   

</div>

</body>
</html>