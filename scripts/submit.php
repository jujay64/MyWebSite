<?php
session_name("fancyform");
session_start();

require_once('functions.php');


/* config end */
foreach($_POST as $k=>$v)
{
    if(ini_get('magic_quotes_gpc'))
        $_POST[$k]=stripslashes($_POST[$k]);

    $_POST[$k]=htmlspecialchars(strip_tags($_POST[$k]));
}


$err = array();

if(!checkLen('name'))
    $err[]=myGetText($_SESSION['locale'],'nameWrong','../');

if(!checkLen('email'))
    $err[]=myGetText($_SESSION['locale'],'emailWrongLength','../');
else if(!checkEmail($_POST['email']))
    $err[]=myGetText($_SESSION['locale'],'invalidEmail','../');

if(!checkLen('subject'))
    $err[]=myGetText($_SESSION['locale'],'wrongSubject','../');

if(!checkLen('message'))
    $err[]=myGetText($_SESSION['locale'],'wrongMessage','../');

if(isset($_POST['captcha']) && isset($_SESSION['expect']))
    if((int)$_POST['captcha'] != $_SESSION['expect'])
        $err[]= myGetText($_SESSION['locale'],'captchaWrong','../');

if(count($err))
{
    if(isset($_POST['ajax']))
    {
        echo '-1';
    }

    else if(isset($_SERVER['HTTP_REFERER']))
    {
        $_SESSION['errStr'] = implode('<br />',$err);
        $_SESSION['post']=$_POST;

        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    exit;
}

/*******************BUILD AND SEND MAIL HERE******************/
$subject = buildMailSubject();
$msg= buidMailMessage();
$to = 'julien.inchausti@supinfo.com'; //insert mail address of receiver
$headers = buildMailHeaders();


mail($to,$subject,$msg,$headers);
/*************************************************************/

unset($_SESSION['post']);

if($_POST['ajax'])
{
    echo '1';
}
else
{
    $_SESSION['sent']=1;

    if($_SERVER['HTTP_REFERER'])
        header('Location: '.$_SERVER['HTTP_REFERER']);

    exit;
}


function checkLen($str,$len=2)
{
    return isset($_POST[$str]) && mb_strlen(strip_tags($_POST[$str]),"utf-8") > $len;
}

function checkEmail($str)
{
    return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
}

function buildMailSubject()
{
    return myGetText($_SESSION['locale'],'newMailTag','../')
        ."[".mb_strtolower($_POST['subject'])."]"
        .$_POST['name']. " "
        .myGetText($_SESSION['locale'],'newMailVia','../');
}

function buidMailMessage()
{
    return '<html>
            <head>
                <title>'.myGetText($_SESSION['locale'],'newMailTitle','../').'</title>
            </head>
            <body>
                Name:	'.$_POST['name'].'<br />
                Email:	'.$_POST['email'].'<br />
                IP:	    '.$_SERVER['REMOTE_ADDR'].'<br /><br />
                Message:<br /><br />'.nl2br(utf8_decode($_POST['message']))
        .'</body>
            </html>';
}

function buildMailHeaders()
{
    $headers = 'From: '.$_POST['name'].' <'.$_POST['email'].'>' . "\r\n";
    $headers .= "X-Mailer: PHP ".phpversion()."\n";
    $headers .= "X-Priority: 1 \n";
    $headers .= "Mime-Version: 1.0\n";
    $headers .= "Content-Transfer-Encoding: 8bit\n";
    $headers .= "Content-type: text/html; charset= utf-8\n";
    $headers .= "Date:" . date("D, d M Y h:s:i") . " +0200\n";

    return $headers;
}
?>
