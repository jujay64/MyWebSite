<?php
function myGetText($loc = '', $block = 'notext',$path='') { // fonction allant chercher la traduction d'un bloc donné dans le fichier xml de localisation. Prend en paramètre la langue à utiliser, et l'élément contenant le texte. L'élément a pour le nom l'ID du block où on va afficher le texte
    if ($loc === '') { // si loc n'existe pas
        $loc = $_SESSION['locale']; // on lui assigne la variable de session
    }
    $doc = simplexml_load_file($path.'lang/lang.xml'); // on charge le fichier de localisation
    $resultat = $doc ->xpath($loc.'/'.$block); // on va chercher le noeud correct
    if (!empty($resultat)) { // si le tableau n'est pas vide, il y a un texte
        foreach ($resultat as $noeud) {
            return $noeud; // on renvoie ce texte
        }
    }
    else {
        $resultat = $doc ->xpath($loc.'/notext'); // sinon on va chercher le message d'erreur
        foreach ($resultat as $noeud) {
            return $noeud;
        }
    }
}
?>
