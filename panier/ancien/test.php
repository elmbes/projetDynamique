<?php
session_start();
/* Initialisation du panier */
$_SESSION['panier'] = array();
/* Article exemple */
$select = array();
$select['id'] = "phlevis501";
$select['qte'] = 2;
$select['taille'] = "56";
$select['prix'] = 84.95;


/**
 * Ajout d'un article dans le panier
 *
 * @param array $select variable tableau associatif contenant les valeurs de l'article
 */
function ajout($select)
{
    array_push($_SESSION['panier']['id'],$select['id']);
    array_push($_SESSION['panier']['qte'],$select['qte']);
    array_push($_SESSION['panier']['taille'],$select['taille']);
    array_push($_SESSION['panier']['prix'],$select['prix']);
}
/**
 * Ajout d'un article dans le panier
 *
 * @param array $select variable tableau associatif contenant les valeurs de l'article
 */
function ajoutPanier($id,$qte,$taille,$prix)
{
    array_push($_SESSION['panier']['id'],$id);
    array_push($_SESSION['panier']['qte'],$qte);
    array_push($_SESSION['panier']['taille'],$taille);
    array_push($_SESSION['panier']['prix'],$prix);
}




/* On vérifie l'existence du panier, sinon, on le crée */
if(isset($_SESSION['panier']))
{
    /* Initialisation du panier */
    $_SESSION['panier'] = array();
    /* Subdivision du panier */
    $_SESSION['panier']['id'] = array();
    $_SESSION['panier']['qte'] = array();
    $_SESSION['panier']['taille'] = array();
    $_SESSION['panier']['prix'] = array();
}


ajoutPanier("vm654321",1,"34",434.95);
ajoutPanier("bonf",2,34,55);

/* Affichons maintenant le contenu du panier : */
?>
<pre>
<?php
var_dump($_SESSION['panier']);
?>
</pre>
