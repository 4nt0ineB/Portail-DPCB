<!DOCTYPE html>
<html>
<?php
require_once("includes/mysql.php");
session_start();
if (!isset($_SESSION["logged"]) || $_SESSION["permission"] != "1") header("location: index.php"); //Vérifie si une session client est en cours sinon renvoi à l'index
?>

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1cQRFi3dgfSVKpc1B9idTEuN3cBScszNHP9silYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

    <!-- CDN Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <!-- plugins Datatable -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
    <script type=" text/javascript" charset="utf8" src="assets/js/tableplugins.js"></script>

    <!-- css pour l'option "column visibility" des plugins -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css">
</head>

<body>
    <!-- Import de la nav-->
    <?php include('includes/nav.php'); ?>
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
                                    <div class="skills portfolio-info-card" style="width: 100%;margin-bottom: 15px;padding: 25px;">
                                        <p class="text-uppercase text-left text-dark" style="margin: 0;text-align: left;font-weight: bold;width: 100%;float: left;">
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
                                                                    :&nbsp;</label><input type="number" name="num_impaye"></td>
                                                    </tr>
                                                    <tr>
                                                        <form method="post">
                                                            <td><label>Date de début :&nbsp;</label><input type="date" name="debut"></td>
                                                            <td><label>Date de fin :&nbsp;</label><input type="date" name=fin></td>
                                                            <td style="text-align: center;"><button class="btn btn-primary" type="submit" style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">Rechercher</button>
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

                                if (isset($_POST['siren'])) {
                                    if ($_POST['siren'] != "") {
                                        $siren = $_POST['siren'];
                                    }
                                }

                                if (isset($_POST['sociale'])) {
                                    if ($_POST['sociale'] != "") {
                                        $sociale = $_POST['sociale'];
                                    }
                                }

                                if (isset($_POST['num_impaye'])) {
                                    if ($_POST['num_impaye'] != "") {
                                        $num_impaye = $_POST['num_impaye'];
                                    }
                                }

                                if (isset($_POST['debut'])) {
                                    if ($_POST['debut'] != "") {
                                        $debut = $_POST['debut'];
                                    }
                                }

                                if (isset($_POST['fin'])) {
                                    if ($_POST['fin'] != "") {
                                        $fin = $_POST['fin'];
                                    }
                                }
                                $today = date("Y-m-d");
                                $no_debut = "0000-01-01";
                                $requete = "SELECT * FROM `IMPAYE` i JOIN DEVISE ON i.id_devise = DEVISE.id_devise, (SELECT * FROM `REMISE` WHERE id_client = (SELECT id_client FROM CLIENT WHERE id_user = $id)) r  WHERE r.id_remise = i.id_remise";
                                if (isset($siren)) $requete .= " AND i.siren LIKE '%$siren%'";
                                if (isset($sociale)) $requete .= " AND raison LIKE '%$sociale%'";
                                if (isset($num_impaye)) $requete .= " AND num_dossier LIKE '%$num_impaye%'";
                                if (isset($fin) && isset($debut)) $requete .= " AND date_vente BETWEEN '$debut' AND '$fin'";
                                else if (isset($debut)) $requete .= " AND date_vente BETWEEN '$debut' AND '$today'";
                                else if (isset($fin)) $requete .= " AND date_vente BETWEEN '$no_debut' AND '$fin'";

                                $resultat = $db->query($requete);

                                ?>
                                <!--
                                <div class="row">
                                    <div class="col">
                                        <div class="btn-toolbar" style="margin-bottom: 10px;float: right;border-style: none;">
                                            <div class="btn-group" role="group" style="border-width: 0px;border-style: none;"><button class="btn btn-primary" type="button" style="color: rgb(0,0,0);background: rgb(255,255,255);border: 1px solid rgb(0,0,0);border-bottom-left-radius: 10px;border-top-left-radius: 10px;box-shadow: 0px 0px 2px;">XLS</button>
                                                <button class="btn btn-primary" type="button" style="background: rgb(255,255,255);color: rgb(0,0,0);border-style: solid;border-color: rgb(0,0,0);box-shadow: 0px 0px 3px;">CSV</button><button class="btn btn-primary" type="button" style="background: rgb(255,255,255);color: rgb(0,0,0);border-color: rgb(0,0,0);border-top-right-radius: 10px;border-bottom-right-radius: 10px;box-shadow: 0px 0px 3px;">PDF</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->



                                <table id="datatable" class="table table-striped table-bordered" width="100%">
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