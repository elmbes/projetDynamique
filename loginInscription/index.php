<!DOCTYPE html>
<?php
session_start();
//connection a la base de données 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

//série de test et de condtion pour le formulaire.
if (isset($_POST["envoyer"])) {
    //Si les champs son vide affiche un message d'erreur sinon traite les données.
    if (!empty($_POST["mail"]) and !empty($_POST["pass"])) {

        //htmlspecialchars permet de securiser les donner envoyer pour elever les caractere html pour eviter les injection de code.
        $mail = htmlspecialchars($_POST["mail"]);

        //hasher le mot de passe pour ne pas le stocker en clair.
        $pass = sha1($_POST["pass"]);

        //retire tous les espaces etc..
        

        $verifDonner = $bdd->prepare("SELECT * FROM membres where mail=? AND motdepasse=?");
        $verifDonner->execute(array($mail,$pass));
        $membreExiste = $verifDonner->rowCount();

        if($membreExiste == 1){
            $membreInfo = $verifDonner->fetch();

            $_SESSION['pseudo'] = $membreInfo["pseudo"];
            $_SESSION['mail'] = $membreInfo["mail"];
            $_SESSION['pass'] = $membreInfo["motdepasse"];
            
            //header('Location : 127.0.0.1/page/membre.php');
            echo "<h1 align=center> Espace membre</h1>";
            echo "<h2 >bienvenue</h2> ". $_SESSION['pseudo'];
            echo '<br>';
            echo '<br>';
            echo "Votre adresse mail ".$_SESSION['mail'];
            echo '<br>';
            echo "Votre mdp ". $_SESSION['pass'];
            echo '<br>';
            
        }else{
            $erreur = "Mail ou mot de passe incorect.";
        }

    } else {
        //nous allons stocker un message d'erreur dans une variable.
        $erreur = "Tous les champs doivent etre saisie..";
    }
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>formulairePHP</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="login-dark" style="width: 100vw;height: 100vh;">
        <form method="post" action="">
            <h2 class="sr-only">Connexion</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="mail" placeholder="Mail"></div>
            <div class="form-group"><input class="form-control" type="password" name="pass" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="envoyer">Log In</button></div>
            <a class="forgot" href="pages/forget.html">mot de passe oublié</a>
            <?php
            //Condition pour afficher un message d'erreur.
                if (isset($erreur)) {
                echo '<br><font color="red">' . $erreur . '<font>';
                }
            ?>
        </form>
        <button class="btn btn-primary btn-block"  onclick= "window.location.href = 'inscription.php';">Inscription</button>

    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>