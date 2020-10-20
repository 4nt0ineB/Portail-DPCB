<?php


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
    <?php include('includes/nav.php'); ?>
    <main class="page cv-page">
        <section class="portfolio-block cv">
            <h2 class="text-center">Gestion des comptes</h2>
            <div class="container-fluid">
                <div class="group" style="max-width: 90%;">
                    <div class="row">
                        <div class="col">
                            <div class="skills portfolio-info-card">
                                <?php
                                $statusModify = isset($_POST['id_modify_client']);
                                $statusDelete = isset($_POST['id_delete_client']);

                                ?>
                                <h2><?php if ($statusModify) echo "Modification de compte";
                                    elseif ($statusDelete) {
                                        echo "Suppression de compte";
                                    }
                                    else echo  "Création de compte"; ?></h2>
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

                                                        <?php

                                                        if (!($statusDelete)) {
                                                            if($statusModify){
                                                                $id_modify_client = $_POST['id_modify_client'];
                                                                $udata = $db->query("SELECT * FROM `CLIENT` NATURAL JOIN `USER` WHERE `permission` = 1 AND id_client = $id_modify_client")->fetch();

                                                            }

                                                            ?>
                                                            <form method="post" name="creation">

                                                                <td>
                                                                    <label style="font-style: normal;">Username :&nbsp;</label>
                                                                    <input type="text" name="username" value=<?php if ($statusModify) echo $udata["username"] . ""; ?> >
                                                                </td>
                                                                <td>
                                                                    <label style="font-style: normal;">Mot de passe :&nbsp;</label>
                                                                    <input type="text" name="mdp"></td>
                                                                <td>
                                                                    <label>N° SIREN :&nbsp;</label>
                                                                    <input type="text" name="siren" value=<?php if ($statusModify) echo $udata["siren"] . ""; ?> >
                                                                </td>
                                                                <td>
                                                                    <label style="font-style: normal;">Raison sociale :&nbsp;</label>
                                                                    <input type="text" name="raison" value="<?php if ($statusModify) echo ($udata["raison"]) ; ?>" > <!-- Problème ?! raison coupé -->
                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                <td colspan="4" style="text-align: center;">
                                                                    <button class="btn btn-primary" type="submit" style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">
                                                                        <?php if ($statusModify) echo "Modifier"; else echo "Créer"; ?>
                                                                    </button>
                                                            </td>
                                                            </form>
                                                            <?php
                                                        }elseif($statusDelete){
                                                            $id_modify_client = $_POST['id_delete_client'];
                                                            $udata = $db->query("SELECT * FROM `CLIENT` NATURAL JOIN `USER` WHERE `permission` = 1 AND id_client = $id_modify_client")->fetch();
                                                            ?>
                                                            <form method="post" name="creation">

                                                                <td>
                                                                    <label style="font-style: normal;">Suppression du compte :&nbsp;</label>
                                                                </td>
                                                                <td>
                                                                    <label style="font-style: normal;">Username :&nbsp;</label>
                                                                    <input type="text" name="username" disabled value=<?php if ($statusDelete) echo $udata["username"] . ""; ?> >
                                                                </td>

                                                                <td>
                                                                    <label>N° SIREN :&nbsp;</label>
                                                                    <input type="text" name="siren" disabled value=<?php if ($statusDelete) echo $udata["siren"] . ""; ?> ></td>
                                                                <td>
                                                                    <label style="font-style: normal;">Raison sociale :&nbsp;</label>
                                                                    <input type="text" name="raison" disabled value=<?php if ($statusDelete) echo $udata["raison"] . ""; ?> > <!-- Problème ?! raison coupé -->
                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                <td>
                                                                    <label style="font-style: normal;">La demande de suppression sera associé à votre nom et le product owner devra la valider:&nbsp;</label>
                                                                </td>
                                                                <td colspan="4" style="text-align: center;">

                                                                    <button class="btn btn-primary" type="submit" style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">
                                                                        Supprimer
                                                                    </button>
                                                            </td>
                                                            </form>
                                                            <?php
                                                        }


                                                        ?>


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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($r = $resultat->fetch()) {



                                            $h = '';
                                            if($statusModify){
                                                if($r['id_client'] == $_POST['id_modify_client']){
                                                    $h = 'style="background-color: orange;"';
                                                }
                                            }
                                            elseif($statusDelete){
                                                if($r['id_client'] == $_POST['id_delete_client']){
                                                    $h = 'style="background-color: red;"';
                                                }
                                            }


                                            echo '<tr '.$h.'><td>' . $r['id_client'] . '</td>
                                                      <td>' . $r['siren'] . '</td>
                                                      <td>' . $r['raison'] . '</td>
                                                      <td>' . $r['username'] . '</td>
                                                      <td>

                                                      <div class="row">
                                                        <div class="col-2">
                                                            <form id="formModify" method="POST" action="">
                                                            <input type="hidden" name="id_modify_client" value="' . $r['id_client'] . '" >
                                                            <button type="submit" style="border: none; background: none;">
                                                                <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="black" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                </svg>

                                                            </button>
                                                            </form>
                                                        </div>
                                                        <div class="col-2">
                                                            <form id="formDelete" method="POST" action="">
                                                            <input type="hidden" name="id_delete_client" value="' . $r['id_client'] . '" >
                                                            <button type="submit" style="border: none; background: none;">
                                                                <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="black" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                                                </svg>
                                                            </button>

                                                            </form>
                                                        </div>
                                                    </div>


                                                      ';
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


    <?php  require_once("includes/footer.php");?>

</body>

</html>
