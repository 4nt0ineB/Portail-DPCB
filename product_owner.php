<?php
session_start();
if (!isset($_SESSION["logged"]) || $_SESSION["permission"] != "2") {
    header("location: index.php");
}
//Vérifie si une session product owner est en cours sinon renvoi à l'index
require_once "includes/mysql.php";
include 'includes/fonctions.php'
?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Portail</title>
    <?php require_once("includes/head.php"); ?>

    <style>
        form.style {
            padding: none;
            max-width: none;
            box-shadow: none;
            padding: none;
            margin: none;
            padding: none;
        }

        .portfolio-block form {
            padding: 0px !important;
        }

        .portfolio-block form {
            max-width: none;
            padding: none;
            margin: auto;
            box-shadow: none;
        }

        @media (min-width: 768px) {

            .portfolio-block form {
                padding: 0px !important;
            }

            .portfolio-block form {
                max-width: none;
                padding: none;
                margin: none;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    <!-- Import de la nav-->
    <?php include 'includes/nav.php'; ?>
    <main class="page cv-page">
        <section class="portfolio-block cv">
            <h2 class="text-center">Trésorerie des comptes clients</h2>
            <div class="container-fluid">
                <div class="group" style="max-width: 90%;">
                    <div class="row">
                        <div class="col">
                            <div class="skills portfolio-info-card">
                                <h2>Comptes clients</h2>
                                <div class="row">
                                    <div class="skills portfolio-info-card" style="width: 100%;margin-bottom: 15px;padding: 25px;">
                                        <p class="text-uppercase text-left text-dark" style="margin: 0;text-align: left;font-weight: bold;width: 100%;float: left;">
                                            <span style="text-decoration: underline;">RECHERCHE DE COMPTES</span></p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <form method="post">
                                                            <td><label>N° SIREN :&nbsp;</label><input type="number" name="siren" min="0"></td>
                                                            <td><label style="font-style: normal;">Raison sociale
                                                                    :&nbsp;<input type="text" name="raison"></label></td>
                                                            <td><label>Date :&nbsp;</label><input type="date" name="date"></td>
                                                    </tr>
                                                    <tr></tr>
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div><button class="btn btn-primary" type="submit" style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;" name="send">Rechercher</button>
                                        </form>
                                    </div>
                                </div>
                                <?php

                                $requete = "SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction, id_client FROM `CLIENT`
                                			JOIN TRANSACTION ON CLIENT.siren = TRANSACTION.siren";

                                if (isset($_POST['siren'])) {
                                    $siren = secure_sqlformat($_POST['siren']);
                                }

                                if (isset($_POST['raison'])) {
                                    $raison = secure_sqlformat(strip_tags($_POST['raison']));
                                }

                                if (isset($_POST['date'])) {
                                    $date = $_POST['date'];
                                }

                                if ((!empty($siren)) || (!empty($raison)) || (!empty($date))) {
                                    $requete .= " WHERE";
                                }
                                // si un des champs du formulaire est remplis on met un WHERE

                                if (!empty($siren)) {
                                    $requete .= " CLIENT.siren = '$siren'";
                                    if ((!empty($raison)) || (!empty($date))) {
                                        $requete .= " AND";
                                    }
                                    // si le champ raison ou date existe on ajoute un AND
                                }
                                if (!empty($raison)) {
                                    $requete .= " CLIENT.raison LIKE '%$raison%'";
                                    if (!empty($date)) {
                                        $requete .= " AND";
                                    }
                                    // si le champ date existe on ajoute un AND
                                }
                                if (!empty($date)) {
                                    $requete .= " date_vente <= '$date'";
                                }

                                $requete .= " GROUP BY CLIENT.siren";
                                $resultat = $db->query($requete);

                                ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>N° SIREN2</th>
                                                        <th>N° SIREN</th>
                                                        <th>Raison sociale</th>
                                                        <th>Nombre de transactions</th>
                                                        <th>Devise</th>
                                                        <th>Montant total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    while ($r = $resultat->fetch()) {
                                                        echo
                                                            '<tr
                                                <td>' . "" . '</td>
                                                <td>' . "" . '</td>
                                                <td>' . $r['siren'] . '</td>
                                                <td>' . $r['raison'] . '</td>
                                                <td>' . $r['nombreTransaction'] . '</td>
                                                <td>EUR</td>
                                                <td>' . $r['montantTransaction'] . '</td>
                                                <td>
                                                <form method="GET" action="tresorerie.php">
                                                    <input type="hidden" name="req" value="' . $r['id_client'] . '" >
                                                    <input type="submit" style="background-color:#61b7e2 !important;border:hidden;">

                                                </form>
                                            </td>
                                               
                                                </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

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

</body>

</html>