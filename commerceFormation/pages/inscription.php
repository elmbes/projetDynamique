<?php require_once("../inc/header.inc.php") ?>

<!DOCTYPE html>
<?php
//connection a la base de données 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=ecommerce', 'root', '');

//série de test et de condtion pour le formulaire.
if (isset($_POST["envoyer"])) {
    if (  !empty($_POST["pseudo"]) and !empty($_POST["mail"]) and !empty($_POST["mdp"]) and !empty($_POST["mdpConfirm"])
    and !empty($_POST["nom"]) and !empty($_POST["prenom"]) and !empty($_POST["profil"]) and !empty($_POST["civilite"])
    and !empty($_POST["ville"]) and !empty($_POST["postalCode"]) and !empty($_POST["adresse"]) and !empty($_POST["numero"]) ) {

        //htmlspecialchars permet de securiser les donner envoyer pour elever les caractere html pour eviter les injection de code.
         $pseudo = htmlspecialchars($_POST["pseudo"]);
        $mail = htmlspecialchars($_POST["mail"]);
        $mdpConfirm = htmlspecialchars($_POST["mailConfirm"]);

        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $civilite = $_POST["civilite"];
        $profil = "user";

        $adresse = htmlspecialchars($_POST["adresse"]);
        $numero = $_POST["numero"];
        $codePostal = htmlspecialchars($_POST["codePostal"]);
        $ville = htmlspecialchars($_POST["ville"]);

        //hasher le mot de passe pour ne pas le stocker en clair.
        $mdp = sha1($_POST["mdp"]);
        $mdp2 = sha1($_POST["mdp2"]);

        //retire tous les espaces etc..
        $pseudolength = strlen($pseudo);

        //préparation de la requete
        $reqPseudo = $bdd->prepare("SELECT * FROM membre where pseudo=?");
        //execution de la requete
        $reqPseudo->execute(array($pseudo));
        $pseudoExiste = $reqPseudo->rowCount();


        //Verifier si le pseudo et plus petit que 255 caracteres comme choisis dans la creation de la bd.
        if ($pseudolength <= 255) {

            $reqPseudo = $bdd->prepare("SELECT * FROM membre where pseudo=?");
            //Execution de la requette
            $reqPseudo->execute(array($pseudo));
            //compte le nombre de resultat en ligne.
            $pseudoExiste = $reqPseudo->rowCount();

            if ($pseudoExiste == 0) {
                //Si le mail et le mail de comfirmation sont identique alors 
                if ($mail == $mail2) {
                    //Si l'entrer est bien un email.
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                        //préparation de la base de données avec requette.
                        $reqMail = $bdd->prepare("SELECT * FROM membre where mail=?");
                        //Execution de la requette
                        $reqMail->execute(array($mail));
                        //compte le nombre de resultat en ligne.
                        $mailExiste = $reqMail->rowCount();

                        //Si le mail n'a pas ete utiliser alors continuer les verification sinon afficher un message d'erreur.
                        if ($mailExiste == 0) {

                        /*************************************************************************************************************/
                        /*************************************************************************************************************/
                            //Confirmation des deux adresse mail.
                            //SI OUI ENVOYE DES DONNES DANS LA BD
                            if ($mdp == $mdp2) {
                                //préparation de la base de données avec requette.
                                $insertMbr = $bdd->prepare("INSERT into membre(pseudo,mail,motdepasse,numero,adresse,dateNaissance) VALUES(?,?,?,?,?,?) ");
                                //execution de la requete.
                                $insertMbr->execute(array($pseudo, $mail, $mdp,$numero,$adresse,$dateNaissance));
                                //Message de confirmation.
                                $erreur = "Votre compte a bien été crée.";
                            } else {
                                $erreur = 'Vos mots de passe ne correspondent pas.';
                            }
                        /*************************************************************************************************************/
                        /*************************************************************************************************************/

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
            } else {
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
        body {
            background-image: url(assets/img/star-sky.jpg);
        }

        table {
            background-color: white;
            border: 4px solid black;
            border-radius: 10px;
            margin: 10px;
        }

        h2 {
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
                        <label for="mailConfirm"> Confirmation du mail : </label>
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
                        <label for="mdpConfirm"> Confirmation mot de passe : </label>
                    </td>
                    <td>
                        <input type="password" name="mdp2" id="mdp2" placeholder="Confirmation votre mot de passe">
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        <label for="nom"> nom : </label>
                    </td>
                    <td>
                        <input type="text" name="mdp2" id="mdp2" placeholder="Confirmation votre mot de passe">
                    </td>
                </tr>
                

                <tr>
                    <td align="right">
                        <label for="adresse"> Adresse </label>
                    </td>
                    <td>
                        <input type="text" name="adresse" id="adresse" placeholder="Votre adresse">
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

<?php require_once("../inc/footer.inc.php") ?>