<?php
session_start();
if (!isset($_SESSION["logged"])) header("location: index.php"); //Vérifie si une session est en cours sinon renvoi à l'index
require_once("includes/mysql.php");
include('includes/fonctions.php')
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Portail</title>
    <link rel="icon" href="assets/img/favicon2.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
</head>

<body>
    <!-- Import de la nav-->
    <?php include('includes/nav.php'); ?>
    <main class="page cv-page">
        <section class="portfolio-block cv">
            <h2 class="text-center"><span style="color: #7C71F5;">
                    <?php
                    $id = $_SESSION["logged"];
                    $query = $db->query("SELECT raison FROM USER NATURAL JOIN CLIENT WHERE id_user = $id")->fetch();
                    echo $query['raison'];
                    ?>
                </span></h2>
            <div class="container">
                <div class="group">
                    <div class="row">
                        <div class="col">
                            <div class="skills portfolio-info-card">
                                <h2>Résumé du compte</h2>
                                <p class="text-uppercase text-center text-success border-success" data-toggle="tooltip" data-bs-tooltip="" title="Votre solde" style="font-size: 40px;text-shadow: 0px 0px 4px rgb(150,150,150);">
                                    <?php
                                    $idu = $_SESSION['logged'];
                                    $r = $db->query("SELECT SUM(montant_remise) solde FROM REMISE WHERE id_client = (SELECT id_client FROM USER NATURAL JOIN CLIENT WHERE id_user = $idu)")->fetch();
                                    echo number_format($r["solde"], 2, ',', ' ') . "€";

                                    ?>
                                </p>
                                <p class="text-center" style="height: 23px;margin-top: -24px;font-size: 14px;"><em>Votre
                                        solde</em><br></p>

                                <!--
                                <div class="row">
                                    <div class="col" style="text-align: center;">
                                        <div class="btn-group open" style="border-style: none;"><button class="btn btn-primary" type="button" style="background: rgb(255,255,255);color: rgb(0,0,0);border: 1px solid rgb(0,0,0) ;">Actions</button><button class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="true" type="button" style="background: rgb(255,255,255);color: rgb(0,0,0);border-style: solid;border-color: rgb(0,0,0);"></button>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">Voir les
                                                    impayés</a><a class="dropdown-item" href="#">Voir le résumé de
                                                    toutes les transactions</a><a class="dropdown-item" href="#">Autre</a></div>
                                        </div>
                                    </div>
                                </div>
                                -->
                                <h1 style="font-size: 20px;border-width: 1px;border-style: none;border-bottom-style: dotted;">
                                    Détails</h1>
                                <div class="row">
                                    <div class="skills portfolio-info-card" style="width: 100%;padding: 25px;margin-bottom: 15px;">
                                        <p class="text-uppercase text-left text-dark" data-toggle="tooltip" data-bs-tooltip="" style="margin: 0;text-align: left;font-weight: bold;width: 80%;float: left;" title="Impayés"><span style="text-decoration: underline;">Total impayés au cours du dernier mois
                                            </span></p><span class="text-right text-danger" style="width: 20%;float: right;">
                                            <?php
                                            $a = date("Y-m-d");
                                            $b = date("Y-m-d", strtotime('-1 months'));
                                            $r = $db->query("SELECT SUM(montant_impaye) total_impaye FROM IMPAYE i JOIN REMISE r ON r.id_remise = i.id_remise WHERE r.id_client = (SELECT id_client FROM USER NATURAL JOIN CLIENT WHERE id_user = $idu) AND date_vente <= '$a' AND date_vente >= '$b' ")->fetch();
                                            echo number_format($r["total_impaye"], 2, ',', ' ') . "€";

                                            ?>
                                        </span>
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
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>