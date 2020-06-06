<?php

function testerRequette($requette){
    global $mybd;
    $resultat = $mybd->query($requette);
    if(!$resultat){
        exit("Erreur : requete SQL incorrecte<br>Message : ".$mybd->error."<br> Code : ".$requette);
    }

    return $resultat;
}

function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px; float: right; clear: both; ">';
    $trace = debug_backtrace();
    $trace = array_shift($trace);
    echo 'Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].';
    if($mode === 1)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }
    echo '</div>';
}

?>