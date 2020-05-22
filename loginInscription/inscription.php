<!DOCTYPE html>
<?php
//connection a la base de données 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

//série de test et de condtion pour le formulaire.
if (isset($_POST["envoyer"])) {
    if (!empty($_POST["pseudo"]) and !empty($_POST["mail"]) and !empty($_POST["mail2"]) and !empty($_POST["mdp"]) and !empty($_POST["mdp2"])) {
        //htmlspecialchars permet de securiser les donner envoyer pour elever les caractere html pour eviter les injection de code.
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $mail = htmlspecialchars($_POST["mail"]);
        $mail2 = htmlspecialchars($_POST["mail2"]);

        //hasher le mot de passe pour ne pas le stocker en clair.
        $mdp = sha1($_POST["mdp"]);
        $mdp2 = sha1($_POST["mdp2"]);
        
        //retire tous les espaces etc..
        $pseudolength = strlen($pseudo);

        //préparation de la requete
        $reqPseudo = $bdd->prepare("SELECT * FROM membres where pseudo=?");
        //execution de la requete
        $reqPseudo->execute(array($pseudo));
        $pseudoExiste = $reqPseudo->rowCount();


        //Verifier si le pseudo et plus petit que 255 caracteres comme choisis dans la creation de la bd.
        if ($pseudolength <= 255) {

            $reqPseudo = $bdd->prepare("SELECT * FROM membres where pseudo=?");
            //Execution de la requette
            $reqPseudo->execute(array($pseudo));
            //compte le nombre de resultat en ligne.
            $pseudoExiste = $reqPseudo->rowCount();

            if($pseudoExiste == 0){
                //Si le mail et le mail de comfirmation sont identique alors 
                if ($mail == $mail2) {
                    //Si l'entrer est bien un email.
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                        //préparation de la base de données avec requette.
                        $reqMail = $bdd->prepare("SELECT * FROM membres where mail=?");
                        //Execution de la requette
                        $reqMail->execute(array($mail));
                        //compte le nombre de resultat en ligne.
                        $mailExiste = $reqMail->rowCount();

                        //Si le mail n'a pas ete utiliser alors continuer les verification sinon afficher un message d'erreur.
                        if ($mailExiste == 0) {
                            if ($mdp == $mdp2) {
                                //préparation de la base de données avec requette.
                                $insertMbr = $bdd->prepare("INSERT into membres(pseudo,mail,motdepasse) VALUES(?,?,?) ");
                                //execution de la requete.
                                $insertMbr->execute(array($pseudo, $mail, $mdp));
                                //Message de confirmation.
                                $erreur = "Votre compte a bien été crée.";
                            } else {
                                $erreur = 'Vos mots de passe ne correspondent pas.';
                            }
                        } else {
                            $erreur = "Adresse mail deja utilisé ";
                        }
                    } else {
                        //Car on peut desactiver l'option dans les balise html (email) car au mode developpeur.
                        $erreur = "Votre adresse mail n'est pas valide";
                    }
                } else {
                    $erreur = "Vos adrresse mail ne correspondent pas.";
                }
            }else{
                $erreur = "Le pseudo est déja utilisée.";
            }
        } else {
            $erreur = "Votre peudo ne peut pas dépasser plus de 255 caractéres.";
        }
        
    } else {
        //nous allons stocker un message d'erreur dans une variable.
        $erreur = "Tous les champs doivent etre compeleter pour pouvoir s'inscrire.";
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
    <style>
        body{
            background-image: url(assets/img/star-sky.jpg);
        }
        table{
            background-color:  white;
            border: 4px solid black;
            border-radius: 10px;
            margin: 10px;
        }
        h2{
            margin-top: 40px;
            color: white;
        }
    </style>
</head>

<body>
    <div align="center">
        <h2>Inscription</h2>
        <br><br><br>
        <form action="" method="post">
            <table>
                <tr>
                    <td align="right">
                        <label for="pseudo"> Pseudo</label>
                    </td>
                    <td>
                        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">

                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail"> mail</label>
                    </td>
                    <td>
                        <input type="email" name="mail" id="mail" placeholder="Votre Mail">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail2"> Confirmation du mail : </label>
                    </td>
                    <td>
                        <input type="email" name="mail2" id="mail2" placeholder="Comfimer votre mail">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp"> Mot de passe : </label>
                    </td>
                    <td>
                        <input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp2"> Confirmation mot de passe : </label>
                    </td>
                    <td>
                        <input type="password" name="mdp2" id="mdp2" placeholder="Confirmation votre mot de passe">
                    </td>
                </tr>
                <tr>

                    <td align="center" colspan="2"><br>
                        <input type="submit" value="Inscription" name="envoyer">
                    </td>
                </tr>
            </table>
            <?php
            //Condition pour afficher un message d'erreur.
            if (isset($erreur)) {
                echo '<br><font color="red">' . $erreur . '<font>';
            }
            ?>
        </form>
    </div>
</body>

</html>