<!DOCTYPE html>
<html>
<?php
require_once "includes/mysql.php";
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


?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Portail</title>
    <?php require_once("includes/head.php"); ?>
</head>

<body>
    <!-- Import de la nav-->
    <?php include 'includes/nav.php'; ?>
    <main class="page cv-page">
        <section class="portfolio-block cv">
            <h2 class="text-center">Impayés du compte de<span style="color: #7C71F5;">
                    <?php
                    $id = (isset($_GET["req"])) ? secure_sqlformat($_GET["req"]) : $_SESSION["logged"];
                    if(empty($id) || !is_numeric($id)){
                        header("location: index.php");

                    }
                    $query = $db->query("SELECT raison FROM USER NATURAL JOIN CLIENT WHERE id_user = $id")->fetch();
                    echo $query['raison'];
                    ?>
                </span></h2>
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
                                $id = (isset($_GET["req"])) ? $_GET["req"] : $_SESSION["logged"];

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
                                if (isset($siren)) {
                                    $requete .= " AND i.siren LIKE '%$siren%'";
                                }

                                if (isset($sociale)) {
                                    $requete .= " AND raison LIKE '%$sociale%'";
                                }

                                if (isset($num_impaye)) {
                                    $requete .= " AND num_dossier LIKE '%$num_impaye%'";
                                }

                                if (isset($fin) && isset($debut)) {
                                    $requete .= " AND date_vente BETWEEN '$debut' AND '$fin'";
                                } else if (isset($debut)) {
                                    $requete .= " AND date_vente BETWEEN '$debut' AND '$today'";
                                } else if (isset($fin)) {
                                    $requete .= " AND date_vente BETWEEN '$no_debut' AND '$fin'";
                                }

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


    <?php  require_once("includes/footer.php");?>

</body>

</html>
