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
    <?php include 'includes/nav.php'; ?>
    <main class="page cv-page">
        <section class="portfolio-block cv">
            <h2 class="text-center">Demande de suppression</h2>
            <div class="container-fluid">
                <div class="group" style="max-width: 90%;">
                    <div class="row">
                        <div class="col">
                            <div class="skills portfolio-info-card">
                                <?php
                                $statusModify = isset($_POST['id_modify_client']);
                                $statusDelete = isset($_POST['id_delete_client']);

                                ?>
                                <h2>Suppresion de compte</h2>

                                <div class="row">
                                    
                                    <div class="skills portfolio-info-card" style="width: 100%;margin-bottom: 15px;padding: 25px;">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    
                                                    <?php if ($statusDelete) { 
                                                        $id_delete_client = $_POST['id_delete_client'];
                                                        $udata = $db->query("SELECT * FROM `CLIENT` NATURAL JOIN `USER` WHERE `permission` = 1 AND id_client = $id_delete_client")->fetch();
                                                    ?>

                                                        <form method="post">

                                                            <td>
                                                                <label style="font-style: normal;">Suppression du compte :&nbsp;</label>
                                                            </td>
                                                            <td>
                                                                <label style="font-style: normal;">Username :&nbsp;</label>
                                                                <input type="text" name="username" readonly value="<?php if ($statusDelete) echo $udata["username"] ?>">
                                                            </td>

                                                            <td>
                                                                <label>N° SIREN :&nbsp;</label>
                                                                <input type="text" name="siren" readonly value="<?php if ($statusDelete) echo $udata["siren"]; ?>"></td>
                                                            <td>
                                                                <label style="font-style: normal;">Raison sociale :&nbsp;</label>
                                                                <input type="text" name="raison" readonly value="<?php if ($statusDelete) echo $udata["raison"] ?>"> <!-- Problème ?! raison coupé -->
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label style="font-style: normal;">Etes vous sûr de vouloir supprimer ce compte ? :&nbsp;</label>
                                                        </td>
                                                        <input type="hidden" name="client_a_suppr" value="<?php echo $id_delete_client ?>">
                                                        <td colspan="4" style="text-align: center;">

                                                            <button class="btn btn-primary" name="subdelete" type="submit" style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">
                                                                Supprimer
                                                            </button>
                                                        </td>
                                                        </form>

                                                        
                                                    <?php
                                                    
                                                        }
                                                        if (isset($_POST["subdelete"])) {

                                                            $id_client = $_POST["client_a_suppr"];
                                                            
                                                            $requete = $db->query($requete = "SELECT id_user FROM `CLIENT` WHERE `id_client` = $id_client")->fetch();
                                                            $id_user = $requete["id_user"];
                                                            $requete2 = $db->prepare("DELETE FROM USER WHERE id_user = $id_user");
                                                            $requete2->execute();
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
                                $requete = "SELECT `id_client`,`siren`,`raison`,`username`,`password` FROM `REQUETE_SUPP` NATURAL JOIN `CLIENT` NATURAL JOIN `USER`";
                                $resultat = $db->query($requete);

                                ?>

                                <?php
                                if (isset($errorMsg)) // si tableau errorMsg initialisé
                                {
                                    foreach ($errorMsg as $error) {
                                ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Oups !</strong> <?php echo $error // on affiche la variable ; 
                                                                    ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php
                                    }
                                }
                                if (isset($successMsg)) // si un message de succès est initialisé
                                {
                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $successMsg; // on affiche le msg 
                                        ?>
                                    </div>
                                <?php
                                }
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
                                        // Faire la meme chose sur le tableau des demandes
                                        while ($r = $resultat->fetch()) {



                                            $h = '';
                                            if ($statusDelete) {
                                                if ($r['id_client'] == $_POST['id_delete_client']) {
                                                    $h = 'style="background-color: red;"';
                                                }
                                            }


                                            echo '<tr ' . $h . '><td>' . $r['id_client'] . '</td>
                                                      <td>' . $r['siren'] . '</td>
                                                      <td>' . $r['raison'] . '</td>
                                                      <td>' . $r['username'] . '</td>
                                                      <td>

                                                      <div class="row">
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