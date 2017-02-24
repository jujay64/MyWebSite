<?php

require_once('scripts/header.php');
require_once('scripts/functions.php');

$_SESSION['n1'] = rand(1,20);
$_SESSION['n2'] = rand(1,20);
$_SESSION['expect'] = $_SESSION['n1']+$_SESSION['n2'];

//On récupère ce qui a été rempli
if(isset($_SESSION['post']['name'])){
    $name = $_SESSION['post']['name'];
}
else{
    $name = '';
}

if(isset($_SESSION['post']['email'])){
    $email = $_SESSION['post']['email'];
}
else{
    $email = '';
}

if(isset($_SESSION['post']['message'])){
    $messsage = $_SESSION['post']['message'];
}
else{
    $message = '';
}

$str='';
if(isset($_SESSION['errStr']))
{
    $str='<div class="error">'.$_SESSION['errStr'].'</div>';
    unset($_SESSION['errStr']);
}

$success='';
if(isset($_SESSION['sent']))
{
    $success='<h1>'.myGetText($_SESSION['locale'],'merci').'</h1>';

    $css='<style type="text/css">#contact-form{display:none;}</style>';

    unset($_SESSION['sent']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Julien INCHAUSTI - Ingénieur web et .Net</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="Je m'appelle Julien Inchausti, je vis actuellement à Tokyo au Japon avec un visa vacances-travail. Je dispose de 5 ans d'expérience en tant que programmeur .Net et assistant chef de projet. Je vous présente ici mon parcours, mes compétences et mes expériences professionnelles."/>
        <meta name="keywords" content="Julien, Inchausti, informatique, .net, web, ingénieur, développeur"/>
        <meta name="language" content="fr"/>
        <script type="text/javascript" src="js/jquery-1.5.1.js"></script>
        <script type="text/javascript" src="js/jquery.lavalamp.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.1.js"></script>
        <?php if($_SESSION['locale'] == 'FR'){ echo '<script type="text/javascript" src="js/jquery.validationEngine-fr.js"></script>'; echo "\n";} ?>
        <script type="text/javascript" src="js/contact.js"></script>
        <script type="text/javascript" src="js/jquery.jqtransform.js"></script>
        <script type="text/javascript" src="js/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="js/fonctions.js"></script>

        <link href="css/jqtransform.css" type="text/css" rel="stylesheet" />
        <link href="css/main.css" type="text/css" rel="stylesheet" />
        <link href="css/validationEngine.jquery.css" type="text/css" rel="stylesheet" />

        <?php if(isset($css)) echo $css ?>

        <link rel="shortcut icon" href="logos/favicon.ico" />
    </head>
    <body>
        <!--BLOC CENTRE-->
        <div id="page">
            <!-- Formulaire pour le choix des langues -->
            <form method="post" action="">
                <input type="submit" value="EN" name="langue" />
                <input type="submit" value="FR" name="langue" />
            </form>

            <!--BANNIERE-->
            <div id="header">
                <!--MENU-->
                <ul id="menu">
                    <li id="liAccueil"><a onclick="AfficherBloc('accueil');return false;" href="#"><?php echo myGetText($_SESSION['locale'],'home'); ?></a></li>
                    <li><a onclick="AfficherBloc('skills');return false;" href="#"><?php echo myGetText($_SESSION['locale'],'skills'); ?></a></li>
                    <!--<li><a onclick="AfficherBloc('bio');" href="#"><?php echo myGetText($_SESSION['locale'],'bio'); ?></a></li>-->
                    <li id="liCV"><a onclick="AfficherBloc('cv');return false;" href="#"><?php echo myGetText($_SESSION['locale'],'cv'); ?></a></li>
                    <li id="liContact"><a onclick="AfficherBloc('contact');return false;" href="#"><?php echo myGetText($_SESSION['locale'],'contact'); ?></a></li>
                </ul>
                <!--FIN MENU-->
                <!--TITRE-->
                <h1>
                    <a class="lienAccueil" onclick="AfficherBloc('accueil');return false;" href="#">
                        <span class="invisible"><?php echo utf8_encode("Julien Inchausti - Portfolio - Ingénieur - Développeur - Intégrateur web et .Net");?></span>
                    </a>
                </h1>
                <!--FIN TITRE-->
                <!--FIN BANNIERE-->
                <br style="clear:both;"/>
                <!--SOUS TITRE-->
                <!-- FIN SOUS TITRE-->
            </div>
            <!--FIN DIV HEADER-->
            <!--CONTENU-->
            <div id="contenu">
                <!--ACCUEIL-->
                <div id="bloc_accueil" class="blocTexte" style="display:block;">
                    <?php echo myGetText($_SESSION['locale'],'blocHome'); ?>
                </div>
                <!--FIN ACCUEIL-->
                <!--SKILLS-->
                <div id="bloc_skills" class="blocTexte" style="display:none;">
                    <?php echo myGetText($_SESSION['locale'],'blocSkills'); ?>
                </div>
                <!--FIN SKILLS-->
                <!--BIO-->
                <div id="bloc_bio" class="blocTexte" style="display:none;">
                    <?php echo myGetText($_SESSION['locale'],'blocBio'); ?>
                </div>
                <!--FIN BIO-->
                <!--CV-->
                <div id="bloc_cv" class="blocTexte" style="display:none;">
                    <?php echo myGetText($_SESSION['locale'],'blocCV'); ?>
                </div>
                <!--FIN CV-->
                <!--CONTACT-->
                <div id="bloc_contact" class="blocTexte" style="display:none;">
                    <?php echo myGetText($_SESSION['locale'],'blocContact'); ?>
                    <!--FORMULAIRE DE CONTACT-->
                    <div id="main-container">
                        <div id="form-container">
                            <!--BOUTON FERMER-->
                            <div id="close">
                                <a class="closeForm" href="#"><img src="images/close.png" alt="close"/></a>
                            </div>
                            <!--FIN BOUTON FERMER-->
                            <h1><?php echo myGetText($_SESSION['locale'],'contactForm'); ?></h1>
                            <h2><?php echo myGetText($_SESSION['locale'],'contactFormSousTitre'); ?></h2>

                            <form id="contact-form" name="contact-form" method="post" action="scripts/submit.php">
                                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr>
                                        <td width="15%"><label for="name"><?php echo myGetText($_SESSION['locale'],'name'); ?></label></td>
                                        <td width="70%"><input type="text" class="validate[required,custom[onlyLetter]]" name="name" id="name" value='<?php echo $name?>' /></td>
                                        <td width="15%" id="errOffset">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><label for="email"><?php echo myGetText($_SESSION['locale'],'email'); ?></label></td>
                                        <td><input type="text" class="validate[required,custom[email]]" name="email" id="email" value='<?php echo $email?>' /></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><label for="subject"><?php echo myGetText($_SESSION['locale'],'subject'); ?></label></td>
                                        <td><select name="subject" id="subject">
                                            <option value="" selected="selected"> - <?php echo myGetText($_SESSION['locale'],'theme'); ?> -</option>
                                            <option value="Question"><?php echo myGetText($_SESSION['locale'],'question'); ?></option>
                                            <option value="Proposition"><?php echo myGetText($_SESSION['locale'],'proposition'); ?></option>
                                            <option value="Suggestion"><?php echo myGetText($_SESSION['locale'],'suggestion'); ?></option>
                                            <option value="Autre"><?php echo myGetText($_SESSION['locale'],'other'); ?></option>
                                            </select>          </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><label for="message"><?php echo myGetText($_SESSION['locale'],'message'); ?></label></td>
                                        <td><textarea name="message" id="message" class="validate[required]" cols="35" rows="5"><?php echo $message?></textarea></td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><label for="captcha"><?php echo $_SESSION['n1']?> + <?php echo $_SESSION['n2']?> =</label></td>
                                        <td><input type="text" class="validate[required,custom[onlyNumber]]" name="captcha" id="captcha" /></td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top">&nbsp;</td>
                                        <td colspan="2"><input type="submit" name="button" id="button" value="<?php echo myGetText($_SESSION['locale'],'submit'); ?>" />
                                            <input type="reset" name="button2" id="button2" value="<?php echo myGetText($_SESSION['locale'],'reset'); ?>" />
                                            <?php if(isset($str)) echo $str ?>
                                            <img id="loading" src="images/ajax-load.gif" width="16" height="16" alt="loading" /></td>
                                    </tr>
                                </table>
                            </form>
                            <?php if(isset($success)) echo utf8_encode($success); ?>
                        </div>
                    </div>
                    <div id="mask"></div>
                    <!--FIN FORMULAIRE DE CONTACT-->
                </div>
                <!--FIN CONTACT-->
            </div>
            <!--FIN CONTENU-->
        </div>
        <!--FIN BLOC CENTRE-->
        <!--BOTTOM-->
        <div id="bottom">

        </div>
        <!--FIN BOTTOM-->
        <input type="hidden" id="hdn_locale" value='<?php echo $_SESSION['locale']?>'/>

        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-22599629-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </body>
</html>
