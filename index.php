<?php include("includes/mysql.php"); ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Contact - UGE</title>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <!-- Refresh auto la page chaque 1sec (ça évite de faire F5 à chaque fois avec xampp)-->
    <script>
        /* setInterval(function() {
            location.reload(true);
        }, 1000); */
    </script>

    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
        <div class="container"><a class="navbar-brand logo" data-bs-hover-animate="bounce" href="#">PORTAIL-DPCB</a>
            <button data-toggle="collapse" class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" data-bs-hover-animate="pulse" href="#">En savoir
                            +</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>Connexion</h2>
                </div>
                <form method="POST">
                    <div class="form-group"><label for="name">Nom d'utilisateur</label><input class="form-control item" type="text" id="name" name="username"></div>
                    <div class="form-group"><label for="email">Mot de passe</label><input class="form-control item" type="password" id="email" name="pass"></div>
                    <div class="form-group"><button id="connection-button" class="btn btn-primary btn-block btn-lg" type="submit" name="send">SE CONNECTER</button></div>
                    <div id="box">
                        <?php
                        if (isset($_SESSION["logged"]) && $_SESSION["permission"] == 1) header("location: tresorerie.php"); //si une session client est déjà lancée redirige vers la page de tresorerie

                        elseif (isset($_SESSION["logged"]) && $_SESSION["permission"] == 2) header("location: product_owner.php"); //si une session product owner est déjà lancée redirige vers la page du product_owner

                        elseif (isset($_SESSION["logged"]) && $_SESSION["permission"] == 3) header("location: admin.php"); //si une session admin est déjà lancée redirige vers la page admin

                        if (isset($_REQUEST['send'])) //si le formulaire est envoyé avec un clic bouton -> "submitBtnLogin"
                        {

                            $username = strip_tags($_REQUEST["username"]);
                            $password  = strip_tags($_REQUEST["pass"]);

                            if (empty($username)) { // si le nom est vide
                                $errorMsg[] = "Veuillez saisir un login"; // on inscrit un message d'erreur dans un tableau (si il y en a plusieurs)
                            } else if (empty($password)) { // si le mdp est vide
                                $errorMsg[] = "Veuillez saisir un mot de passe "; // on inscrit un message d'erreur dans un tableau (si il y en a plusieurs)
                            } else {
                                try {
                                    $select_registered_users = $db->prepare("SELECT * FROM USER WHERE username=:username"); // on selectionne les utilisateurs avec ce pseudo ou cet email
                                    $select_registered_users->execute(array(':username' => $username)); // et on execute la requete avec les champs rentrés par l'utilisateur
                                    $row = $select_registered_users->fetch(PDO::FETCH_ASSOC); // avec la methode de recherche

                                    if ($select_registered_users->rowCount() > 0) // si la requête compte plus de zéro lignes alors
                                    {
                                        if ($username == $row["username"]) // on vérifie si la ligne est bien égale avec le pseudo et l'email rentré par l'utilisateur
                                        {
                                            if (password_verify($password, $row["password"])) // on compare le mdp encrypté stocké en base de donné et le mdp rentré par l'utilisateur
                                            {
                                                $_SESSION["logged"] = $row["id_user"]; // on démarre une session avec l'id user_login qui correspondra à l'id de l'utilisateur
                                                $_SESSION["username"] = $row["username"];
                                                $_SESSION["permission"] = $row['permission'];

                                                $loginMsg = "Connecté avec succès ! Redirection...";  // on initialise un message de succès
                                                if ($_SESSION["permission"] == "1") {
                                                    header("refresh:2; tresorerie.php");   // après 2 secondes on redirige le client sur sa trésorerie
                                                } else if ($_SESSION["permission"] == "2") {
                                                    header("refresh:2; product_owner.php"); // en redirige le product owner sur la page de vue des trésorerie client
                                                } else if ($_SESSION["permission"] == "3") {
                                                    header("refresh:2; admin.php"); // cette page n'existe pas encore
                                                }
                                            } else // si la vérification du mot de passe échoue
                                            {
                                                $errorMsg[] = "Mauvais mot de passe"; // on inscrit un msg d'erreur
                                            }
                                        } else // si la comparaison avec l'entrée de l'utilisateur et la db echoue
                                        {
                                            $errorMsg[] = "Mauvais login"; // on inscrit un msg d'erreur
                                        }
                                    } else // si la comparaison avec l'entrée de l'utilisateur et la db echoue
                                    {
                                        $errorMsg[] = "Mauvais login"; // on inscrit un msg d'erreur
                                    }
                                } catch (PDOException $e) {
                                    $e->getMessage();
                                }
                            }
                        }
                        ?>
                        <?php
                        if (isset($errorMsg)) // si le tableau errorMsg est initialisé
                        {
                            foreach ($errorMsg as $error) // pour chaque ligne du tableau on initalise une variable
                            {
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
                        if (isset($loginMsg)) // si un message de succès est initialisé
                        {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $loginMsg; // on affiche ce message
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </form>

            </div>


        </section>
    </main>
    <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">A propos</a><a href="#">Contactez-nous</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>