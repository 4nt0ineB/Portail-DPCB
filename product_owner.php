<!DOCTYPE html>
<html>
<?php 
require_once("includes/mysql.php");
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
    <link rel="stylesheet" href="style/style.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
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
	
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
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
            <h2 class="text-center">Trésorerie des comptes clients</h2>
            <div class="container-fluid">
                <div class="group" style="max-width: 90%;">
                    <div class="row">
                        <div class="col">
                            <div class="skills portfolio-info-card">
                                <h2>Comptes clients</h2>
                                <div class="row">
                                    <div class="skills portfolio-info-card"
                                        style="width: 100%;margin-bottom: 15px;padding: 25px;">
                                        <p class="text-uppercase text-left text-dark"
                                            style="margin: 0;text-align: left;font-weight: bold;width: 100%;float: left;">
                                            <span style="text-decoration: underline;">RECHERCHE DE COMPTES</span></p>
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
                                                                :&nbsp;<input type="text" name="raison"></label></td>
                                                        <td><label>Date :&nbsp;</label><input type="date" name="date"></td>
                                                   		
                                                    </tr>
                                                    <tr></tr>
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div><button class="btn btn-primary" type="submit"
                                            style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">Rechercher</button>
                                        </form>
                                    </div>
                                </div>
                            
                                <!-- <div class="row">
                                    <div class="col">
                                        <div class="btn-toolbar"
                                            style="margin-bottom: 10px;float: right;border-style: none;">
                                            <div class="btn-group" role="group"
                                                style="border-width: 0px;border-style: none;"><button
                                                    class="btn btn-primary" type="button"
                                                    style="color: rgb(0,0,0);background: rgb(255,255,255);border: 1px solid rgb(0,0,0);border-bottom-left-radius: 10px;border-top-left-radius: 10px;box-shadow: 0px 0px 2px;">XLS</button>
                                                <button class="btn btn-primary" type="button"
                                                    style="background: rgb(255,255,255);color: rgb(0,0,0);border-style: solid;border-color: rgb(0,0,0);box-shadow: 0px 0px 3px;">CSV</button>
                                                    <button
                                                    class="btn btn-primary" type="button"
                                                    style="background: rgb(255,255,255);color: rgb(0,0,0);border-color: rgb(0,0,0);border-top-right-radius: 10px;border-bottom-right-radius: 10px;box-shadow: 0px 0px 3px;">PDF</button> -->
                                                    <!-- <button
                                                    class="btn btn-secondary buttons-pdf buttons-html15" tabindex="0" type="button" aria-controls="datatable"
                                                    style="background: rgb(255,255,255);color: rgb(0,0,0);border-color: rgb(0,0,0);border-top-right-radius: 10px;border-bottom-right-radius: 10px;box-shadow: 0px 0px 3px;">
                                                    <span>PDF </span> -->
                                                    <!--
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            -->
                                <?php

                                	if (isset($_POST['siren'])){
                                		if ($_POST['siren'] != ""){
                                			$siren = $_POST['siren'];
                                		}
                                	}


                                	if (isset($_POST['raison'])){
                                		if ($_POST['raison'] != ""){
                                			$raison = $_POST['raison'];
                                			//echo $raison;
                                		}
                                	}

                                	if (isset($_POST['date'])){
										if ($_POST['date'] != ""){
											$date = $_POST['date'];
										}
                                	} 

                                	if (isset($siren) and isset($raison) and isset($date)){
                                		$resultat = $db->query("SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction FROM `CLIENT` 
                                			JOIN TRANSACTION ON CLIENT.siren = TRANSACTION.siren WHERE CLIENT.raison = '$raison' AND CLIENT.siren = '$siren' AND date_vente = '$date' GROUP BY CLIENT.siren");
                                	}

                                	if (isset($siren) and isset($raison)){
                                		$resultat = $db->query("SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction FROM `CLIENT` 
                                			JOIN TRANSACTION ON CLIENT.siren = TRANSACTION.siren WHERE CLIENT.raison = '$raison' AND CLIENT.siren = '$siren' GROUP BY CLIENT.siren");
                                	}

                                	if (isset($siren) and isset($date)){
                                		$resultat = $db->query("SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction FROM `CLIENT` 
                                			JOIN TRANSACTION ON CLIENT.siren = TRANSACTION.siren WHERE CLIENT.siren = '$siren' AND date_vente = '$date' GROUP BY CLIENT.siren");
                                	}

                                	if (isset($raison) and isset($date)){
                                		$resultat = $db->query("SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction FROM `CLIENT` 
                                			JOIN TRANSACTION ON CLIENT.siren = TRANSACTION.siren WHERE CLIENT.raison = '$raison' AND date_vente = '$date' GROUP BY CLIENT.siren");
                                	}

                                	else if (isset($siren)){
                                		$resultat = $db->query("SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction FROM `CLIENT` 
                                			JOIN TRANSACTION ON CLIENT.siren = TRANSACTION.siren WHERE CLIENT.siren = '$siren' GROUP BY CLIENT.siren");
                                	}


                                	else if (isset($raison)){
                                		$resultat = $db->query("SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction FROM `CLIENT` 
                                			JOIN TRANSACTION ON CLIENT.siren = TRANSACTION.siren WHERE CLIENT.raison = '$raison' GROUP BY CLIENT.siren");
                                	}

                                	else if (isset($date)){
                                		$resultat = $db->query("SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction FROM `CLIENT` JOIN TRANSACTION ON CLIENT.siren = TRANSACTION.siren WHERE date_vente = '$date' GROUP BY CLIENT.siren");
                                	}
                                	

                                	else {
                                		$resultat = $db->query("SELECT DISTINCT(CLIENT.siren) AS siren,`raison`,COUNT(id_transaction) AS nombreTransaction,SUM(montant_transaction) AS montantTransaction FROM `CLIENT` JOIN TRANSACTION ON CLIENT.siren = TRANSACTION.siren GROUP BY CLIENT.siren");
                                	}
                                	


                                ?>
                                <!-- <div class="row">
                                    <div class="col">
                                        <div class="table-responsive"> -->
                    <table id="datatable" class="table table-striped table-bordered">
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
                        /*while ($r = $resultat->fetch()) {
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
                        */

                        while ($r = $resultat->fetch()){
                                                            echo '<tr
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
<!-- <script type=" text/javascript" charset="utf8" src="assets/js/tableplugins.js"> -->
                    </script> 
                                        

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
    <script type=" text/javascript" charset="utf8" src="assets/js/tableplugins.js">
                    </script> 


    <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">A propos</a><a href="#">Contactez-nous</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i
                        class="icon ion-social-instagram-outline"></i></a><a href="#"><i
                        class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/script.min.js"></script>
-->

</body>
<!-- <script type=" text/javascript" charset="utf8" src="assets/js/tableplugins.js">
                    </script> -->

</html>