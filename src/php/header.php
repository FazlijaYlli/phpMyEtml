<?php var_dump($_SESSION); ?>
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
            <?php
                if(isset($_SESSION['logged']))
                {
                    if ($_SESSION['logged']) {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link  btn btn-warning" href="changePassword.php">Changer de mot de passe</a>';
                        echo '</li>';
                    }
                }
            ?>
        </ul>
    </div>
    <ul class="navbar-nav nav navbar-right">
        <?php
        if(isset($_SESSION['logged']))
        {
            if ($_SESSION['logged'])
            {
                ?>
                    <li class="nav-item">
                    <a class="nav-link">Bonjour <?= $_SESSION['user'] ?> !</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="disconnect.php">Se déconnecter</a>
                    </li>
                <?php
            }
        }
        ?>
    </ul>
</nav>
