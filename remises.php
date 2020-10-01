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
                                                        <td><label>N° SIREN :&nbsp;</label><input type="text"></td>
                                                        <td><label style="font-style: normal;">Raison sociale
                                                                :&nbsp;<input type="text"></label></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Date de début :&nbsp;</label><input type="date"></td>
                                                        <td><label>Date de fin :&nbsp;</label><input type="date"></td>
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
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-check text-right"><input class="form-check-input"
                                                        type="radio" id="formCheck-1" name="choicetab"
                                                        value="tabdetaille"><label class="form-check-label"
                                                        for="formCheck-1">Tableau détaillé</label></div>
                                                <div class="form-check text-right"><input class="form-check-input"
                                                        type="radio" id="formCheck-2" checked="" name="choicetab"
                                                        value="tabresume"><label class="form-check-label text-right"
                                                        for="formCheck-2">Tableau résumé</label></div>
                                                <div class="btn-toolbar"
                                                    style="margin-bottom: 10px;float: right;border-style: none;">
                                                    <div class="btn-group" role="group"
                                                        style="border-width: 0px;border-style: none;"><button
                                                            class="btn btn-primary" type="button"
                                                            style="color: rgb(0,0,0);background: rgb(255,255,255);border: 1px solid rgb(0,0,0);border-bottom-left-radius: 10px;border-top-left-radius: 10px;box-shadow: 0px 0px 2px;">XLS</button>
                                                        <button class="btn btn-primary" type="button"
                                                            style="background: rgb(255,255,255);color: rgb(0,0,0);border-style: solid;border-color: rgb(0,0,0);box-shadow: 0px 0px 3px;">CSV</button><button
                                                            class="btn btn-primary" type="button"
                                                            style="background: rgb(255,255,255);color: rgb(0,0,0);border-color: rgb(0,0,0);border-top-right-radius: 10px;border-bottom-right-radius: 10px;box-shadow: 0px 0px 3px;">PDF</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table">
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
                                                    <tr>
                                                        <td>Cell 1</td>
                                                        <td>Cell 2</td>
                                                        <td>Text</td>
                                                        <td>Text</td>
                                                        <td>Text</td>
                                                        <td>Text</td>
                                                        <td>Text</td>
                                                        <td>Text</td>
                                                    </tr>
                                                    <tr></tr>
                                                </tbody>
                                            </table>
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