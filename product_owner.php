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
    <link rel="icon" href="assets/img/favicon2.png">
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
    <?php include 'includes/nav.php';?>
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

$requete = "SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction FROM `CLIENT`
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
    $requete .= " date_vente = '$date'";
}

$requete .= " GROUP BY CLIENT.siren";
$resultat = $db->query($requete);

?>
                                <!-- <div class="row">
                                    <div class="col">
                                        <div class="table-responsive"> -->
                                <table id="datatable" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>N° SIREN</th>
                                            <th>Raison sociale</th>
                                            <th>Nombre de transactions</th>
                                            <th>Devise</th>
                                            <th>Montant total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

while ($r = $resultat->fetch()) {
    echo
        '<tr
                                                <td>' . "" . '</td>
                                                <td>' . $r['siren'] . '</td>
                                                <td>' . $r['raison'] . '</td>
                                                <td>' . $r['nombreTransaction'] . '</td>
                                                <td>EUR</td>
                                                <td>' . $r['montantTransaction'] . '</td>
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