
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
    <title>CV - UGE</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">

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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>

    <!-- css pour l'option "column visibility" des plugins -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css">
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
                    <li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="index.html">Se
                            connecter</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="hire-me.html">En savoir
                            +</a></li>
                </ul>
            </div>
        </div>
    </nav>
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
                                    <div class="skills portfolio-info-card"
                                        style="width: 100%;margin-bottom: 15px;padding: 25px;">
                                        <p class="text-uppercase text-left text-dark"
                                            style="margin: 0;text-align: left;font-weight: bold;width: 100%;float: left;">
                                            <span style="text-decoration: underline;">RECHERCHE DE REMISES</span></p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><label>N° SIREN :&nbsp;</label><input type="text" name="siren"></td>
                                                        <td><label style="font-style: normal;" name="raison">Raison sociale
                                                                :&nbsp;<input type="text"></label></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Date de début :&nbsp;</label><input type="date" name="datedebut"></td>
                                                        <td><label>Date de fin :&nbsp;</label><input type="date" name="datefin"></td>
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

                                <div class="row">
                                    <div class="col">
                                         <table id="datatable" class="table table-striped table-bordered">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $id = $_SESSION["logged"];
                        $requete = "SELECT * FROM REMISE,DEVISE WHERE id_client=$id AND REMISE.id_devise = DEVISE.id_devise;";

                        if (isset($_POST['siren'])) $siren = secure_sqlformat($_POST['siren']);
                        if (isset($_POST['raison'])) $raison = secure_sqlformat(strip_tags($_POST['raison']));
                        if (isset($_POST['datedebut']))  $datedebut = $_POST['datedebut'];
                        if (isset($_POST['datefin']))  $datefin = $_POST['datefin'];


                        $resultat = $db->query($requete);

                        while ($r = $resultat->fetch()){
                                                            echo '<tr>
                                                            <td>' . $r['siren'] . '</td>
                                                            <td>' . $r['raison'] . '</td>
                                                            <td>' . $r['num_remise'] . '</td>
                                                            <td>' . $r['date_traitement'] . '</td>
                                                            <td>' . $r['nbr_transaction'] . '</td>
                                                            <td>' . $r['libelle_devise'] . '</td>
                                                            <td>' . $r['montant_remise'] . '</td>
                                                            <td>' . $r['sens'] . '</td>
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