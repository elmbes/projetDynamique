<?php


/**
 * Fichier qui vq permettre d'inititialiser toutes les constants nécessaire au bon
 * fonctionnenment du site. On y trouve la connexion a la base de donnée, la session,
 * le chemin a partir de l racine de notre site et des variables.
 */



//Initialisation de la connexion a la base de données grace a la classe myslqi.
$mybd= new mysqli("127.0.0.1","root","","ecommerce");

//Vérifie si la connexion a la bd est ok sinon arréte le script et affiche un messsage d'erreur.
if ($mybd->connect_error) exit('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);


//session
session_start();

//Chemin de la racine
define("HSRECUP","/cour/projetDynamique/commerceFormation/");

//Rajout du fichier fonction pour n'appelez que celui-ci.
require_once("fonction.inc.php");


?>