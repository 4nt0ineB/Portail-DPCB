<?php
session_start();
if (!isset($_SESSION["logged"])) { //Vérifie si une session client est en cours sinon renvoi à l'index
    header("location: index.php");
}
if ($_SESSION["permission"] == "1") { //
    if (isset($_GET["req"])) {
        unset($_GET["req"]);
        header("refresh:0; impayes.php");
    }
}
if ($_SESSION["permission"] == "2" && !(isset($_GET["req"]))) { // owner mais pas de get req (id client) -> retour owner
    header("location: product_owner.php");
}

//Vérifie si une session est en cours sinon renvoi à l'index
require_once("includes/mysql.php");
include('includes/fonctions.php');
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/script.min.js"></script>

    <!--Histogramme du solde total et des impayés en fonction des années-->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        google.charts.load('current', {packages: ['corechart', 'line']});
		google.charts.setOnLoadCallback(drawBasic);

        <?php
        $idu = (isset($_GET["req"])) ? $_GET["req"] : $_SESSION["logged"];
        //Renvoi le nombres de barres qui vont être nécessaire à l'histogramme
        $countColumns = $db->query("SELECT COUNT(`date_traitement`) col FROM `REMISE` WHERE id_client = (SELECT id_client FROM USER NATURAL JOIN CLIENT WHERE id_user = $idu)")->fetch();
        //Renvoi le montant total du solde selon l'année ainsi que les impayés selon l'année puis l'année
        $solde = $db->query("SELECT SUM(montant_remise) solde,YEAR(`date_traitement`)annee,SUM(montant_impaye) total_impaye FROM REMISE r,IMPAYE i WHERE id_client = (SELECT id_client FROM USER NATURAL JOIN CLIENT WHERE id_user = $idu) AND r.id_remise = i.id_remise AND r.id_client = (SELECT id_client FROM USER NATURAL JOIN CLIENT WHERE id_user =$idu) GROUP BY YEAR(`date_traitement`)");

        $solde_evolution = $db->query("SELECT SUM(montant_remise) solde,YEAR(`date_traitement`)annee FROM REMISE r,IMPAYE i WHERE id_client = (SELECT id_client FROM USER NATURAL JOIN CLIENT WHERE id_user = 10) AND r.id_remise = i.id_remise AND r.id_client = (SELECT id_client FROM USER NATURAL JOIN CLIENT WHERE id_user =10) GROUP BY YEAR(`date_traitement`)");
        ?>

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Année', 'Solde total', 'Impayés'],
                <?php while ($s = $solde->fetch()) {
                    echo "['" . $s['annee'] . "'," . $s['solde'] . "," . abs($s['total_impaye']) . "],";
                } ?>
            ]);

            var options = {

                title: 'Histogramme Solde et Impayés'

            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_values'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        $(window).resize(function() {
            drawChart();
        });

function drawBasic() {

      var data = new google.visualization.DataTable();

      


      data.addColumn('date', 'Année');
      data.addColumn('number', 'Trésorerie');

      data.addRows([
<?php while ($s = $solde_evolution->fetch()) {
	$date = 'new Date('.$s['annee'].',01,01)'; ?>

	<?php
                    echo "[" . $date . "," . $s['solde'] . "],";
                } ?>
      ]);

      var options = {
      	title: 'Évolution de la trésorerie ces 4 dernières années',
        hAxis: {
          title: 'Années'
        },
        vAxis: {
          title: 'Trésorerie'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('evolution'));

      chart.draw(data, options);
    }

    </script>
    <style>
        .chart {
            width: 100%;
            min-height: 450px;
        }
    </style>

</head>

<body>
    <!-- Import de la nav-->
    <?php include 'includes/nav.php'; ?>
    <main class="page cv-page">
        <section class="portfolio-block cv">
            <h2 class="text-center"><span style="color: #7C71F5;">
                    <?php
                    $id = (isset($_GET["req"])) ? secure_sqlformat($_GET["req"]) : $_SESSION["logged"];
                    if (empty($id) || !is_numeric($id)) {
                        header("location: index.php");
                    }
                    $query = $db->query("SELECT raison FROM USER NATURAL JOIN CLIENT WHERE id_user = $id")->fetch();
                    echo $query['raison'];
                    ?>
                </span></h2>
            <div class="container">
                <div class="group">
                    <div class="row">
                        <div class="col">
                            <div class="skills portfolio-info-card">
                                <h2 style="float: left;width: 45%;">Résumé du compte</h2>
                                <div style="width: 55%;float: right;">
                                    <form method="post" style="box-shadow:none;max-width: none;margin:0 !important;padding:0 !important;">
                                        <label>Solde au :&nbsp;</label><input type="date" name="date">
                                        <button class="btn btn-primary" type="submit" style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">Rechercher</button>
                                </div>
                                <br>


                                <?php

                                $no_debut = "0000-01-01";
                                $requete = "SELECT SUM(montant_remise) solde FROM REMISE WHERE id_client = (SELECT id_client FROM USER NATURAL JOIN CLIENT WHERE id_user = $idu)";
                                if (isset($_POST['date'])) {
                                    if ($_POST['date'] != "") {
                                        $date = $_POST['date'];
                                    }
                                }
                                if (isset($date)) $requete .= "AND date_traitement BETWEEN '$no_debut' AND '$date'";
                                $r = $db->query($requete)->fetch();
                                if ($r["solde"] >= 0) echo '<p class="text-uppercase text-center text-success border-success" data-toggle="tooltip" data-bs-tooltip="" title="Votre solde" style="width:100%;margin-top: 60px;float:left;line-height: 0px;font-size: 40px;text-shadow: 0px 0px 4px rgb(150,150,150);">';
                                else echo '<p class="text-uppercase text-center text-danger border-success" data-toggle="tooltip" data-bs-tooltip="" title="Votre solde" style="font-size: 40px;text-shadow: 0px 0px 4px rgb(150,150,150);">';
                                echo number_format($r["solde"], 2, ',', ' ') . "€";
                                ?>
                                </p>
                                <p class="text-center" style="height: 23px;margin-top: -24px;font-size: 14px;"><em>Votre
                                        solde</em><br></p>
                                <div class="row">
                                    <div class="skills" style="width: 100%;padding: 25px;margin-bottom: 15px;">
                                        <br>
                                        <p class="text-uppercase text-center text-danger border-success" data-toggle="tooltip" data-bs-tooltip="" title="Votre solde" style="font-size: 40px;text-shadow: 0px 0px 4px rgb(150,150,150);">
                                            <?php
                                            $today = date("Y-m-d");
                                            $req = "SELECT SUM(montant_impaye) total_impaye FROM IMPAYE i JOIN REMISE r ON r.id_remise = i.id_remise WHERE r.id_client = (SELECT id_client FROM USER NATURAL JOIN CLIENT WHERE id_user = $idu)";
                                            if (isset($date)) $req .= "AND date_vente BETWEEN '$no_debut' AND '$date'";
                                            else $req .= "AND date_vente BETWEEN '$no_debut' AND '$today'";
                                            $r = $db->query($req)->fetch();
                                            echo number_format($r["total_impaye"], 2, ',', ' ') . "€";

                                            ?>
                                            <p class="text-center" style="height: 23px;margin-top: -24px;font-size: 14px;"><em>Vos impayés</em><br></p>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <div class="skills portfolio-info-card">
                                <div id="columnchart_values" class="chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <div class="skills portfolio-info-card">
                                <div id="evolution" class="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>



    </main>
    <?php require_once("includes/footer.php"); ?>
</body>

</html>