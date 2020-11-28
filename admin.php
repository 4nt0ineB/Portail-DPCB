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
    <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.0.2/js/dataTables.rowGroup.min.js"></script>

    <!-- css pour l'option "column visibility" des plugins -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css">
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
                                <h2>Suppresion de compte</h2>
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

                                                        if (!($statusDelete)) { // formulaire de suppression non choisi
                                                            if ($statusModify) { // formulaire de modification choisi
                                                                $id_modify_client = $_POST['id_modify_client'];
                                                                $udata = $db->query("SELECT * FROM `CLIENT` NATURAL JOIN `USER` WHERE `permission` = 1 AND id_client = $id_modify_client")->fetch();
                                                            }

                                                        ?>
                                                            <form method="post">

                                                                <td>
                                                                    <label style="font-style: normal;">Username :&nbsp;</label>
                                                                    <input type="text" name="username" required pattern="[A-Za-z0-9]{1,20}" value=<?php if ($statusModify) echo $udata["username"] . ""; ?>>
                                                                </td>
                                                                <td>
                                                                    <label style="font-style: normal;">Mot de passe :&nbsp;</label>
                                                                    <input type="text" pattern="[^'\x22]+" title="guillemets interdits" placeholder="laisser vide si inchangé" name="mdp"></td>
                                                                <td>
                                                                    <label>N° SIREN :&nbsp;</label>
                                                                    <input type="text" name="siren" required pattern="{1,20}" value=<?php if ($statusModify) echo $udata["siren"] . ""; ?>>
                                                                </td>
                                                                <td>
                                                                    <label style="font-style: normal;">Raison sociale :&nbsp;</label>
                                                                    <input type="text" name="raison" required pattern="[A-Za-z0-9 ]{1,20}" value="<?php if ($statusModify) echo ($udata["raison"]); ?>"> <!-- Problème ?! raison coupé -->
                                                                </td>
                                                                <input type="hidden" name="client_a_modif" value="<?php echo $id_modify_client ?>">
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;">
                                                            <button class="btn btn-primary" name="submodify" type="submit" style="text-align: center;background: rgba(255,255,255,0);color: rgb(0,0,0);box-shadow: 0px 0px 3px;border-style: none;">
                                                                <?php if ($statusModify) echo "Modifier";
                                                                else echo "Créer"; ?>
                                                            </button>
                                                        </td>
                                                        </form>
                                                    <?php
                                                        } elseif ($statusDelete) {
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
                                                            <label style="font-style: normal;">La demande de suppression sera associé à votre nom et le product owner devra la valider:&nbsp;</label>
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

                                                        if (isset($_POST["submodify"])) {

                                                            $username = $_POST["username"];
                                                            $siren = $_POST["siren"];
                                                            $raison = $_POST["raison"];
                                                            $id_client = $_POST["client_a_modif"];
                                                            $mdp = $_POST["mdp"];

                                                            $requete = "SELECT * FROM `CLIENT` NATURAL JOIN `USER` WHERE permission = 1 AND id_client !=$id_client AND";
                                                            $s_unsername = $db->query("$requete `username`=\"$username\"")->rowCount();
                                                            $s_siren =  $db->query("$requete `siren`=\"$siren\"")->rowCount();
                                                            $s_raison = $db->query("$requete `raison`=\"$raison\"")->rowCount();

                                                            if ($s_unsername != 0 || $s_siren != 0 || $s_raison != 0) {
                                                                $errorMsg[] = "Une des informations que vous avez rentré est déjà renseignée dans notre base de donnée.";
                                                            } else {

                                                                if (!empty($username)) {
                                                                    $db->query("UPDATE USER SET username=\"$username\" WHERE id_user = $id_client");
                                                                }
                                                                if (!empty($siren)) {
                                                                    $db->query("UPDATE CLIENT SET siren=\"$siren\" WHERE id_user = $id_client");
                                                                }
                                                                if (!empty($raison)) {
                                                                    $db->query("UPDATE CLIENT SET raison=\"$raison\" WHERE id_user = $id_client");
                                                                }
                                                                if (!empty($mdp)) {
                                                                    $idu = $db->query("SELECT id_user FROM USER NATURAL JOIN CLIENT WHERE id_client = $id_client")->fetch();
                                                                    $idu = $idu["id_user"];
                                                                    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                                                                    $db->query("UPDATE USER SET password=\"$mdp\" WHERE id_user = $idu");
                                                                }
                                                                $successMsg = "Le client a été modifié avec succès.";
                                                                echo '<meta http-equiv="refresh" content="1;URL="">';
                                                            }
                                                        } elseif (isset($_POST["subdelete"])) {


                                                            $id_client = $_POST["client_a_suppr"];
                                                            $s_client = $db->query("SELECT id_client FROM REQUETE_SUPP WHERE id_client = $id_client")->rowCount();
                                                            if ($s_client != 0) {
                                                                $errorSuppMsg = "Vous avez déjà fait une requête de suppression pour ce client !";
                                                            } else {
                                                                $requete = $db->prepare("INSERT INTO REQUETE_SUPP (id_client) VALUES (:id_client)");
                                                                $requete->bindParam(':id_client', $id_client);
                                                                $requete->execute();

                                                                $successSuppMsg = "La demande de suppression du client à été envoyé avec succès.";
                                                                echo '<meta http-equiv="refresh" content="1;URL="">';
                                                            }
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
                                if (isset($successSuppMsg)) {
                                ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $successSuppMsg;
                                        ?>
                                    </div>
                                <?php
                                }
                                if (isset($errorSuppMsg)) {
                                ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <?php echo $errorSuppMsg;
                                        ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
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
                                        while ($r = $resultat->fetch()) {



                                            $h = '';
                                            if ($statusModify) {
                                                if ($r['id_client'] == $_POST['id_modify_client']) {
                                                    $h = 'style="background-color: orange;"';
                                                }
                                            } elseif ($statusDelete) {
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
    <script>

    </script>

    <?php require_once("includes/footer.php"); ?>

</body>

</html>
<script>
    $(document).ready(function() {
        var collapsedGroups = {};
        var table = $('#datatable').DataTable({
            /* scrollY: 500,
            paging: false, */ // pour mettre une scroll bar à la place
            "lengthMenu": [
                [5, 10, 20, 50, 100, 200, -1],
                [5, 10, 20, 50, 100, 200, "Tous"]
            ],
            "language": { // traduction en français de la table
                buttons: {
                    "copy": "Copier",
                    "colvis": "Visibilité des colonnes",
                    "testbutt": "Test Translated",
                    "coldemo": "Collection Demo Translated"
                },
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
                "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
                "sInfoPostFix": "",
                "sInfoThousands": ",",
                "sLengthMenu": "Afficher _MENU_ éléments",
                "sLoadingRecords": "Chargement...",
                "sProcessing": "Traitement...",
                "sSearch": "Rechercher :",
                "sZeroRecords": "Aucun élément correspondant trouvé",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sLast": "Dernier",
                    "sNext": "Suivant",
                    "sPrevious": "Précédent"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                },
                "select": {
                    "rows": {
                        "_": "%d lignes sélectionnées",
                        "0": "Aucune ligne sélectionnée",
                        "1": "1 ligne sélectionnée"
                    }
                }
            },
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            columnDefs: [{
                className: 'control',
                orderable: false,
                targets: 0
            }]

        });

        table.buttons().container()
            .appendTo('#datatable_wrapper .col-md-6:eq(0)');

        $('#btn-show-all-doc').on('click', expandCollapseAll);

        function expandCollapseAll() {
            table.rows('.parent').nodes().to$().find('td:first-child').trigger('click').length ||
                table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click')
        }

        $('#datatable tbody').on('click', 'tr.group-start', function() {
            var name = $(this).data('name');
            collapsedGroups[name] = !collapsedGroups[name];
            table.draw(false);
        });

    });
</script>