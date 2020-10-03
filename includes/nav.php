<?php
$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);


?>

<nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
    <div class="container"><a class="navbar-brand logo" data-bs-hover-animate="bounce" href="#">PORTAIL-DPCB</a>
        <button data-toggle="collapse" class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav ml-auto">
                <?php


                if (isset($_SESSION['logged'])) {
                    if ($_SESSION['permission'] == "1") { // si l'utilisateur est un client

                        // on affiche les liens des pages sauf celui de la page courante
                        if ($curPageName != "tresorerie.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="tresorerie.php">Trésorerie</a></li>';
                        }
                        if ($curPageName != "remises.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="remises.php">Remises</a></li>';
                        }
                        if ($curPageName != "impayes.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="impayes.php">Impayés</a></li>';
                        }
                    }

                    echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="logout.php">Déconnexion</a></li>';
                }
                ?>
                <li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="#">En savoir +</a></li>
            </ul>
        </div>
    </div>
</nav>