<?php
header('Content-type: text/html; charset=utf-8');
session_name("fancyform");
session_start ();
function checkLocale () { // fonction pour tenter de déterminer la langue utilisée par le système client (non garantie)
    $locale = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    switch(substr ($locale, 0, 2))
    {
        case 'fr':
            return 'FR';
        case 'en':
            return 'EN';
        default:
            return false;
    }
}

// On vérifie le choix de la langue dans le formulaire, et on assigne la valeur correcte à la variable de session
if (isset ($_POST['langue'])) {
    $_SESSION['locale'] = $_POST['langue'];
}

if (!isset ($_SESSION['locale'])) {
    if (false !== ($check = checkLocale ())) {
        $_SESSION['locale'] = $check;
    }
    else {
        $_SESSION['locale'] = 'EN'; // on met une langue par défaut dans une variable de session
    }
}

?>
