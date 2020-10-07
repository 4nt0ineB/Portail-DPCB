<?php
require_once("includes/mysql.php");

session_start();
if (!isset($_SESSION["logged"]) || $_SESSION["permission"] != "3") header("location: index.php"); //Vérifie si une session est en cours sinon renvoi à l'index
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
            <h2 class="text-center">Gestion des comptes</h2>
            <div class="container-fluid">
                <div class="group" style="max-width: 90%;">
                    <div class="row">
                        <div class="col">
                            <div class="skills portfolio-info-card">
                                <h2>Création de compte</h2>
                                <div class="row">
                                    <div class="skills portfolio-info-card" style="width: 100%;margin-bottom: 15px;padding: 25px;">
                                        <p class="text-uppercase text-left text-dark" style="margin: 0;text-align: left;font-weight: bold;width: 100%;float: left;">
                                            <span style="text-decoration: underline;">Information de compte</span></p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <form method="post" name="creation">

                                                            <td><label style="font-style: normal;">Username :
                                                                    &nbsp;</label><input type="text" name="username"></td>
                                                            <td><label style="font-style: normal;">Mot de passe :
                                                                    &nbsp;</label><input type="text" name="mdp"></td>
                                                            <td><label>N° SIREN :&nbsp;</label><input type="text" name="siren"></td>
                                                            <td><label style="font-style: normal;">Raison sociale :
                                                                    &nbsp;<input type="text" name="raison"></label></td>
                                                    </tr>
                                                    <tr>
                                                            <td style="text-align: center;"><button class="btn btn-primary" type="submit" style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">Créer</button>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                    <tr></tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                     $requete = "SELECT `id_client`,`siren`,`raison`,`username`,`password` FROM `CLIENT` NATURAL JOIN `USER` WHERE `permission` = 1";
                                     $resultat = $db->query($requete);
                                     
                                ?>

                                <table id="datatable" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>id_client</th>
                                            <th>N° SIREN</th>
                                            <th>Raison sociale</th>
                                            <th>Nom d'utilisateur</th>
                                            <th>Mot de passe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($r = $resultat->fetch()) {
                                            echo '<tr>
                                                      <td>' . $r['id_client'] . '</td>
                                                      <td>' . $r['siren'] . '</td>
                                                      <td>' . $r['raison'] . '</td>
                                                      <td>' . $r['username'] . '</td>
                                                      <td>' . $r['password'] . '</td>';
                                                      
                                        }
                                        ?>

                                    </tbody>
                                </table>

                                <?php
                                    //if (isset())
                                ?>

                            
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