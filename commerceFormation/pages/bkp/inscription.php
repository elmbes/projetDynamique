<?php require_once("../inc/header.inc.php") ?>

<?php
//connection a la base de données 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

//série de test et de condtion pour le formulaire.
if (isset($_POST["inscription"])) {
    if (
        !empty($_POST["pseudo"]) and !empty($_POST["mail"]) and !empty($_POST["mdp"]) and !empty($_POST["mdpConfirm"])
        and !empty($_POST["nom"]) and !empty($_POST["prenom"]) and !empty($_POST["profil"]) and !empty($_POST["civilite"])
        and !empty($_POST["ville"]) and !empty($_POST["postalCode"]) and !empty($_POST["adresse"]) and !empty($_POST["numero"])
    ) {

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
        $mdp2 = sha1($_POST["mdpConfirm"]);

        //retire tous les espaces etc..
        $pseudolength = strlen($pseudo);

        //préparation de la requete
        $reqPseudo = $mybd->prepare("SELECT * FROM membre where pseudo=?");
        //execution de la requete
        $reqPseudo->execute(array($pseudo));
        $pseudoExiste = $reqPseudo->rowCount();


        //Verifier si le pseudo et plus petit que 30 caracteres comme choisis dans la creation de la bd.
        if ($pseudolength <= 30) {

            $reqPseudo = $mybd->prepare("SELECT * FROM membre where pseudo=?");
            //Execution de la requette
            $reqPseudo->execute(array($pseudo));
            //compte le nombre de resultat en ligne.
            $pseudoExiste = $reqPseudo->rowCount();

            if ($pseudoExiste == 0) {
                //Si le mail et le mail de comfirmation sont identique alors 
                if ($mail == $mailConfirm) {
                    //Si l'entrer est bien un email.
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                        //préparation de la base de données avec requette.
                        $reqMail = $mybd->prepare("SELECT * FROM membre where mail=?");
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
                            if ($mdp == $mdpConfirm) {
                                //préparation de la base de données avec requette.
                                $insertMembre = $mybd->prepare("INSERT into membre(pseudo,email,mdp,nom,prenom,profil,civilite,ville,postalcode,adresse,numero) VALUES(?,?,?,?,?,?,?,?,?,?,?) ");
                                //execution de la requete.
                                $insertMembre->execute(array($pseudo, $mail, $mdp, $nom, $prenom, $profil, $civilite, $ville, $postalcode, $adresse, $numero));
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
            $erreur = "Votre peudo ne peut pas dépasser plus de 30 caractéres.";
        }
    } else {
        //nous allons stocker un message d'erreur dans une variable.
        $erreur = "Tous les champs doivent etre compléter pour pouvoir s'inscrire.";
    }
}





?>







<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" placeholder="votre pseudo" required="required"><br><br>

    <label for="mail">Email</label><br>
    <input type="mail" id="mail" name="mail" placeholder="exemple@gmail.com"><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" required="required"><br><br>

    <label for="mdpConfirm">comfirmation mot de passe</label><br>
    <input type="password" id="mdpConfirm" name="mdpConfirm" required="required"><br><br>




    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" placeholder="votre nom"><br><br>

    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" placeholder="votre prénom"><br><br>

    <label for="civilite">Civilité</label><br>
    <input name="civilite" value="m" checked="" type="radio">Homme
    <input name="civilite" value="f" type="radio">Femme<br><br>




    <label for="ville">Ville</label><br>
    <input type="text" id="ville" name="ville" placeholder="votre ville"><br><br>

    <label for="codePostal">Code Postal</label><br>
    <input type="text" id="codePostal" name="codePostal" placeholder="code postal"><br><br>

    <label for="adresse">Adresse</label><br>
    <textarea id="adresse" name="adresse" placeholder="votre adresse"></textarea><br><br>

    <label for="numero">Nuémro</label><br>
    <input id="numero" name="numero" placeholder="votre numéro"></input><br><br>

    <input type="submit" name="inscription" value="S'inscrire">
    <?php
            //Condition pour afficher un message d'erreur.
            if (isset($erreur)) {
                echo '<br><font color="red">' . $erreur . '<font>';
            }
            ?>
</form>


<?php require_once("../inc/footer.inc.php") ?>