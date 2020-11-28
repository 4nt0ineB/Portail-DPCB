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
require_once("includes/mysql.php");
include('includes/fonctions.php')
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Portail</title>
    <?php require_once("includes/head.php"); ?>
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

                                                $id = (isset($_GET["req"])) ? secure_sqlformat($_GET["req"]) : $_SESSION["logged"];
                                                if (empty($id) || !is_numeric($id)) {
                                                    header("location: index.php");
                                                }
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

                                                    if ($r['sens'] == "-") {
                                                        $color = "background-color: rgba(255, 0, 0, 0.35)";
                                                    } else {
                                                        $color = NULL;
                                                    }

                                                    echo '<tr style="' . $color . '">
                                                            <td>' . $r['siren'] . '</td>
                                                            <td>' . $r['raison'] . '</td>
                                                            <td>' . $r['num_remise'] . '</td>
                                                            <td>' . date_format(date_create($r['date_traitement']), "d/m/yy") . '</td>
                                                            <td>' . $r['nbr_transaction'] . '</td>
                                                            <td>' . $r['libelle_devise'] . '</td>
                                                            <td>' . number_format(abs($r['montant_remise']), 2, ',', ' ') . '</td>
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
                                                        if ($t['sens'] == "-") {
                                                            $color = "background-color: rgba(255, 0, 0, 0.35)";
                                                        } else {
                                                            $color = NULL;
                                                        }
                                                        echo '
                                                              <tr style="' . $color . '">
                                                              <td>' . $t['siren'] . '</td>
                                                              <td>' . date('d/m/Y', strtotime($t['date_vente'])) . '</td>
                                                              <td>' . $t['num_carte'] . '</td>
                                                              <td>' . $t['reseau'] . '</td>
                                                              <td>' . $t['num_autorisation'] . '</td>
                                                              <td>' . $r['libelle_devise'] . '</td>
                                                              <td>' . number_format(abs($t['montant_transaction']), 2, ',', ' ') . '</td>
                                                              <td>' . $t['sens'] . '</td>
                                                              </tr>';
                                                    }
                                                    echo '
                                                              </tbody>
                                                              </table>
                                                            </td>
                                                            </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>

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
    <?php require_once("includes/footer.php"); ?>
</body>

</html>