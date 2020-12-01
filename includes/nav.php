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

                    // boolean true si owner et client définit pour owner
                    $permOwner = ($_SESSION["permission"] == "2" && (isset($_GET["req"])));
                    // si condition precedante true -> poursuivra le get vers les autres pages
                    $inputOwner = ($permOwner) ? '?req=' . $_GET["req"] : "";

                    if ($_SESSION['permission'] == "2") {
                        if ($curPageName != "product_owner.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="product_owner.php">Clients</a></li>';
                        }
                        if ($curPageName != "remises.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="remises.php?all">Remises(Toutes)</a></li>';
                        }
                        if ($curPageName != "impayes.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="impayes.php?all">Impayés(Toutes)</a></li>';
                        }
                        if ($curPageName != "owner_suppression_compte.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="owner_suppression_compte.php">Suppression</a></li>';
                        }
                        if ($curPageName != "statistiques.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="statistiques.php">Stats</a></li>';
                        }
                    }
                    if ($_SESSION['permission'] == "3") {
                        if ($curPageName != "admin.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="admin.php">Utilisateurs</a></li>';
                        }
                        if ($curPageName != "admin_suppression.php") {
                            echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="admin_suppression.php">Suppression</a></li>';
                        }
                    }

                    if ($_SESSION['permission'] == "1" || $permOwner) { // si l'utilisateur est un client

                        if (!($curPageName == "product_owner.php")) {
                            // on affiche les liens des pages sauf celui de la page courante
                            if ($curPageName != "tresorerie.php") {
                                echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="tresorerie.php' . $inputOwner .  '">Trésorerie</a></li>';
                            }
                            if ($curPageName != "remises.php") {
                                echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="remises.php' . $inputOwner .  '">Remises</a></li>';
                            }
                            if ($curPageName != "impayes.php") {
                                echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="impayes.php' . $inputOwner .  '">Impayés</a></li>';
                            }
                        }
                    }
                    echo '<li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="logout.php">Déconnexion</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>