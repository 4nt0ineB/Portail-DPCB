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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1cQRFi3dgfSVKpc1B9idTEuN3cBScszNHP9silYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
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
    <script src="https://cdn.datatables.net/rowgroup/1.0.2/js/dataTables.rowGroup.min.js"></script>

    <!-- css pour l'option "column visibility" des plugins -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css">

</head>

<body>
    <!-- Import de la nav-->
    <?php include('includes/nav.php'); ?>
    <main class="page cv-page">
        <section class="portfolio-block cv">
            <h2 class="text-center">Remises</h2>
            <div class="container-fluid">
                <div class="group" style="max-width: 90%;">
                    <div class="row">
                        <div class="col">
                            <div class="skills portfolio-info-card">
                                <h2>Tableau des remises</h2>
                                <div class="row">
                                    <div class="skills portfolio-info-card" style="width: 100%;margin-bottom: 15px;padding: 25px;">
                                        <p class="text-uppercase text-left text-dark" style="margin: 0;text-align: left;font-weight: bold;width: 100%;float: left;">
                                            <span style="text-decoration: underline;">RECHERCHE DE REMISES</span></p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                                <tbody>
                                                    <form method="post">
                                                        <tr>
                                                            <td><label>N° SIREN :&nbsp;</label><input type="text" name="siren"></td>
                                                            <td><label style="font-style: normal;" name="raison">Raison sociale
                                                                    :&nbsp;<input type="text"></label></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Date de début :&nbsp;</label><input type="date" name="datedebut"></td>
                                                            <td><label>Date de fin :&nbsp;</label><input type="date" name="datefin"></td>
                                                            <td style="text-align: center;"><button type="sumbit" class="btn btn-primary" type="button" style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">Rechercher</button>
                                                            </td>
                                                        </tr>
                                                        <tr></tr>
                                                    </form>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <table id="datatable" class="table table-striped table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>N° SIREN</th>
                                                    <th>Raison sociale</th>
                                                    <th>N° remise</th>
                                                    <th>Date traitement</th>
                                                    <th>Nb transactions</th>
                                                    <th>Devise</th>
                                                    <th>Montant total</th>
                                                    <th>Sens</th>
                                                    <th class="none">Détails des transactions</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $id = $_SESSION["logged"];
                                                $requete = "SELECT * FROM REMISE,DEVISE ";

                                                if (isset($_POST['siren'])) $siren = secure_sqlformat($_POST['siren']);
                                                if (isset($_POST['raison'])) $raison = secure_sqlformat(strip_tags($_POST['raison']));
                                                if (isset($_POST['datedebut']))  $datedebut = $_POST['datedebut'];
                                                if (isset($_POST['datefin']))  $datefin = $_POST['datefin'];

                                                if ((!empty($siren)) || (!empty($raison)) || (!empty($datedebut)) || (!empty($datefin))) {
                                                    $requete .= "WHERE";
                                                } else {
                                                    $requete .= " WHERE id_client=$id AND REMISE.id_devise = DEVISE.id_devise";
                                                } // si un des champs du formulaire est remplis on met un WHERE

                                                if (!empty($siren)) {
                                                    $requete .= " REMISE.siren = '$siren'";
                                                    if ((!empty($raison))  || (!empty($datedebut)) || (!empty($datefin))) $requete .= " AND"; // si le champ raison ou date existe on ajoute un AND
                                                }
                                                if (!empty($raison)) {
                                                    $requete .= " REMISE.raison LIKE '%$raison%'";
                                                    if (!empty($date)) $requete .= " AND"; // si le champ date existe on ajoute un AND
                                                }
                                                if (!empty($datedebut) && empty($datefin)) {
                                                    $requete .= " REMISE.date_traitement >= '$datedebut'";
                                                }
                                                if (!empty($datefin) && empty($datedebut)) {
                                                    $requete .= " REMISE.date_traitement <= '$datefin'";
                                                }
                                                if (!empty($datefin) && !empty($datedebut)) {
                                                    $requete .= " REMISE.date_traitement <= '$datefin' AND REMISE.date_traitement >= '$datedebut'";
                                                }

                                                $requete .= " AND id_client=$id AND REMISE.id_devise = DEVISE.id_devise";

                                                $resultat = $db->query($requete);

                                                while ($r = $resultat->fetch()) {

                                                    $idremise = $r["id_remise"];

                                                    $transaction = $db->query("SELECT * FROM TRANSACTION WHERE id_remise=$idremise;");

                                                    if ($r['sens'] == "-"){
                                                      $color = "background-color: rgba(255, 0, 0, 0.35)";
                                                    } else {
                                                      $color = NULL;
                                                    }

                                                    echo '<tr style="'.$color.'">
                                                            <td>' . $r['siren'] . '</td>
                                                            <td>' . $r['raison'] . '</td>
                                                            <td>' . $r['num_remise'] . '</td>
                                                            <td>' . date_format(date_create($r['date_traitement']), "d/m/yy") . '</td>
                                                            <td>' . $r['nbr_transaction'] . '</td>
                                                            <td>' . $r['libelle_devise'] . '</td>
                                                            <td>' . $r['montant_remise'] . '</td>
                                                            <td>' . $r['sens'] . '</td>
                                                            <td>
                                                            <table style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>N° SIREN</th>
                                                                    <th>Date de vente</th>
                                                                    <th>N° Carte</th>
                                                                    <th>Réseau</th>
                                                                    <th>N° Autorisation</th>
                                                                    <th>Devise</th>
                                                                    <th>Montant</th>
                                                                    <th>Sens</th>
                                                                  </tr>
                                                            </thead>
                                                              <tbody>';
                                                              while ($t = $transaction->fetch()) {
                                                                if ($t['sens'] == "-"){
                                                                  $color = "background-color: rgba(255, 0, 0, 0.35)";
                                                                } else {
                                                                  $color = NULL;
                                                                }
                                                              echo'
                                                              <tr style="'.$color.'">
                                                              <td>' . $t['siren'] . '</td>
                                                              <td>' . $t['date_vente'] . '</td>
                                                              <td>' . $t['num_carte'] . '</td>
                                                              <td>' . $t['reseau'] . '</td>
                                                              <td>' . $t['num_autorisation'] . '</td>
                                                              <td>' . $r['libelle_devise'] . '</td>
                                                              <td>' . $t['montant_transaction'] . '</td>
                                                              <td>' . $t['sens'] . '</td>
                                                              </tr>'; } echo'
                                                              </tbody>
                                                              </table>
                                                            </td>
                                                            </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <script type=" text/javascript" charset="utf8" src="assets/js/tableplugins.js">
                                        </script>

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
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
</body>

</html>
