<?php include("includes/mysql.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Portail-DPCB</title>

    <!-- bootstrap -->
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

    <style>
        body {
            background: linear-gradient(87deg, rgb(92, 214, 230), rgb(151, 65, 236));
        }

        table {
            background-color: white;
        }
    </style>
</head>

<body>

    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">

                <?php
                session_start();
                //imaginons qu'on a cette session :
                $_SESSION["id_user"] = 4;
                $_SESSIOn["username"] = "Tincidunt";
                $_SESSION["permission"] = 1;

                //par exemple on veut tous les impayés auquel cette pauvre entreprise fait face

                $id = $_SESSION['id_user'];
                $resultat = $db->query("SELECT * FROM `IMPAYE` i JOIN DEVISE ON i.id_devise = DEVISE.id_devise, (SELECT * FROM `REMISE` WHERE id_client = (SELECT id_client FROM CLIENT WHERE id_user = $id)) r  WHERE r.id_remise = i.id_remise");

                ?>

                <table id="datatable" class="table table-striped table-bordered"">
                    <thead>
                        <tr>
                            <th>N°SIREN</th>
                            <th>Date vente</th>
                            <th>Date remise</th>
                            <th>N°Carte</th>
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
                            <td>' . $r['montant_impaye'] . '</td>
                            <td>' . $r['libelle'] . '</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </section>
    </main>


</body>
<!-- ne pas oublier sinon ça marchera pas :p et c'est aussi pour le mettre en français-->
<script type=" text/javascript" charset="utf8" src="assets/js/tableplugins.js">
                    </script>

</html>