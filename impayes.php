<!DOCTYPE html>
<html>
<?php
require_once("includes/mysql.php");
session_start();
if(!isset($_SESSION["logged"]) || $_SESSION["permission"] != "1") header("location: index.php"); //Vérifie si une session client est en cours sinon renvoi à l'index
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CV - UGE</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient"
        style="border-bottom-style: solid;border-bottom-color: rgba(0,0,0,0.16);text-shadow: 0px 0px 3px rgb(0,0,0);background: linear-gradient(87deg, rgb(92, 214, 230), rgb(151, 65, 236));">
        <div class="container"><a class="navbar-brand logo" data-bs-hover-animate="bounce" href="#"
                style="font-family: 'Alegreya Sans SC', sans-serif;">UGE MANAGER</a><button data-toggle="collapse"
                class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="index.php">Se
                            connecter</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="hire-me.html">En savoir
                            +</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page cv-page">
        <section class="portfolio-block cv">
            <h2 class="text-center">Impayés du compte bancaire n°XXXXXXXXX</h2>
            <div class="container-fluid">
                <div class="group" style="max-width: 90%;">
                    <div class="row">
                        <div class="col">
                            <div class="skills portfolio-info-card">
                                <h2>Impayés du compte</h2>
                                <div class="row">
                                    <div class="skills portfolio-info-card"
                                        style="width: 100%;margin-bottom: 15px;padding: 25px;">
                                        <p class="text-uppercase text-left text-dark"
                                            style="margin: 0;text-align: left;font-weight: bold;width: 100%;float: left;">
                                            <span style="text-decoration: underline;">RECHERCHE D'IMPAYéS</span></p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                      <form method="post">
                                                        <td><label>N° SIREN :&nbsp;</label><input type="text" name="siren"></td>
                                                        <td><label style="font-style: normal;">Raison sociale
                                                                :&nbsp;<input type="text" name="sociale"></label></td>
                                                        <td><label style="font-style: normal;">N° d'impayé
                                                                :&nbsp;</label><input type="number" name="impaye"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Date de début :&nbsp;</label><input type="date" name="debut"></td>
                                                        <td><label>Date de fin :&nbsp;</label><input type="date" name=fin></td>
                                                        <td style="text-align: center;"><button class="btn btn-primary"
                                                                type="button"
                                                                style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">Rechercher</button>
                                                        </td>
                                                    </tr>
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $id = $_SESSION["logged"];
                                $resultat = $db->query("SELECT * FROM `IMPAYE` i JOIN DEVISE ON i.id_devise = DEVISE.id_devise, (SELECT * FROM `REMISE` WHERE id_client = (SELECT id_client FROM CLIENT WHERE id_user = $id)) r  WHERE r.id_remise = i.id_remise");

                                ?>

                                <div class="row">
                                    <div class="col">
                                        <div class="btn-toolbar"
                                            style="margin-bottom: 10px;float: right;border-style: none;">
                                            <div class="btn-group" role="group"
                                                style="border-width: 0px;border-style: none;"><button
                                                    class="btn btn-primary" type="button"
                                                    style="color: rgb(0,0,0);background: rgb(255,255,255);border: 1px solid rgb(0,0,0);border-bottom-left-radius: 10px;border-top-left-radius: 10px;box-shadow: 0px 0px 2px;">XLS</button>
                                                <button class="btn btn-primary" type="button"
                                                    style="background: rgb(255,255,255);color: rgb(0,0,0);border-style: solid;border-color: rgb(0,0,0);box-shadow: 0px 0px 3px;">CSV</button><button
                                                    class="btn btn-primary" type="button"
                                                    style="background: rgb(255,255,255);color: rgb(0,0,0);border-color: rgb(0,0,0);border-top-right-radius: 10px;border-bottom-right-radius: 10px;box-shadow: 0px 0px 3px;">PDF</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>N° SIREN</th>
                                                        <th>Date vente</th>
                                                        <th>Date remise</th>
                                                        <th>N° carte</th>
                                                        <th>Réseau</th>
                                                        <th>N° dossier impayé</th>
                                                        <th>Devise</th>
                                                        <th>Montant</th>
                                                        <th>Libellé</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                  while ($r = $resultat->fetch()) {
                                                      echo '<tr>
                                                      <td>' . $r['siren'] . '</td>
                                                      <td>' . $r['date_vente'] . '</td>
                                                      <td>' . $r['date_remise'] . '</td>
                                                      <td>' . $r['num_carte'] . '</td>
                                                      <td>' . $r['reseau'] . '</td>
                                                      <td>' . $r['num_dossier'] . '</td>
                                                      <td>' . $r['libelle_devise'] . '</td>
                                                      <td>' . number_format($r['montant_impaye'], 2, '.', ' ') . '</td>
                                                      <td>' . $r['libelle'] . '</td>
                                                      </tr>';
                                                  }
                                                  ?>
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hobbies group">
                    <div class="heading"></div>
                </div>
            </div>
        </section>
    </main>
    <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">A propos</a><a href="#">Contactez-nous</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i
                        class="icon ion-social-instagram-outline"></i></a><a href="#"><i
                        class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
