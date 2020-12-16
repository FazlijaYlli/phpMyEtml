<?php
session_start();
if(isset($_POST['passwordSubmit']))
{
    include 'lib/database.php';
    $db = new Database();
    $arrayErrors = array();

    if($_POST['username'])
    {
        if($db->getIdByUsername($_POST['username']))
        {
            if($db->getOneStudent($db->getIdByUsername($_POST['username'])[0]['idEleve']))
            {
                $eleve = $db->getOneStudent($db->getIdByUsername($_POST['username'])[0]['idEleve']);
                $idEleve = $eleve[0]['idEleve'];
                $oldPasswordHash = $eleve[0]['elePassword'];
                $oldPassword = $_POST['oldPassword'];
                $newPassword = $_POST['newPassword'];
                $newPasswordConfirm = $_POST['newPasswordConfirm'];

                //TRAITEMENT DU CHANGEMENT DE MOT DE PASSE
                //Comparaison avec l'ancien mot de passe.
                if(!password_verify($oldPassword,$oldPasswordHash))
                {
                    $arrayErrors[] = "L'ancien mot de passe ne correspond pas.";
                }

                //Comparaison des deux nouveaux mots de passe.
                if($newPassword != $newPasswordConfirm)
                {
                    $arrayErrors[] = "Les mots de passe ne correspondent pas.";
                }

                //Si un des champs est vide.
                if(empty($newPassword) || empty($newPasswordConfirm) || empty($oldPassword))
                {
                    $arrayErrors[] = "Les champs doivent tous être remplis.";
                }

                //SI LE FORMULAIRE EST CORRECTEMENT REMPLI
                if(empty($arrayErrors))
                {
                    //Connexion à la base de données
                    $hash = password_hash($newPassword,PASSWORD_BCRYPT);
                    $db->changePassword($idEleve, $hash);
                    $success = true;
                }
            }
        }
        else
        {
            $arrayErrors[] = "Le nom d'utilisateur n'existe pas.";
        }
    }
    else
    {
        $arrayErrors[] = "Veuillez renseigner un nom d'utilisateur.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!--
            ETML
            NOM : FAZLIJA YLLI
            DATE : 09.12.20
            DESCRIPTION : Page de changement de mots de passe. L'utilisateur doit entrer son ancien mot de passe ainsi que son nouveau mot de passe.
        -->
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
            <h1 class="my-3">Changement de mot de passe</h1>
            <?php
                if(!empty($arrayErrors))
                {
                    echo '<div class="alert alert-danger">';
                    echo '<ul class="m-0">';
                    foreach($arrayErrors as $error)
                    {
                        echo '<li>'.$error.'</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                }

                if (isset($success)) {
                    if ($success) {
                        echo '<div class="alert alert-success">';
                        echo "Votre mot de passe a bien été changé !";
                        echo '</div>';
                    }
                }
            ?>
            <form method="post" action="#" enctype="multipart/form-data" name="changePasswordForm">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php if(isset($_POST['username'])) { echo $_POST['username']; } ?>">
                </div>
                <div class="form-group">
                    <label for="oldPassword">Ancien mot de passe</label>
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                </div>
                <div class="form-group">
                    <label for="newPassword">Nouveau Mot de passe</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                </div>
                <div class="form-group">
                    <label for="newPasswordConfirm">Confirmation du nouveau mot de passe</label>
                    <input type="password" class="form-control" id="newPasswordConfirm" name="newPasswordConfirm">
                </div>
                <div class="text-left">
                    <input class="btn btn-primary my-3" type="submit" name="passwordSubmit" id="passwordSubmit" value="Confirmer">
                </div>
            </form>
        </div>
    </body>
</html>