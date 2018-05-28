<?php
// cela signife que l'utilisateur était déjà venu, et j'avais déjà enregistré son choix dans un cookie.
if(isset($_COOKIE['pseudo'])){
    $pseudo = $_COOKIE['pseudo'];
}

$an = 365 * 24 * 60 *60; // = 1 an

setCookie('user', $_POST['pseudo'], time() + $an); // setCookie() nous permet de créer un cookie. La fonction attend 3 arguments :
setCookie('password', $_POST['password'], time() + $an);
setCookie('select',$_POST['select'],time() + $an);


/*
1 : Le nom du cookie
2 : La valeur du cookie
3 : La date d'expiration (timestamp)
*/

// JAMAIS de code HTML avant un setCookie !!!!!
// Detecter les infos client
$navigateur = $_SERVER['HTTP_USER_AGENT'];
$adresse_ip = $_SERVER['REMOTE_ADDR'];
/*
$_SERVER["PHP_SELF"]  Contient  Le nom du fichier du script en cours d'exécution
$_SERVER["SCRIPT_NAME"]  Contient le nom du script courant
$_SERVER["DOCUMENT_ROOT"]  Contient  la racine du serveur
$_SERVER["HTTP_REFERER"]  Contient L'URI qui a été fourni pour accéder à cette page
$_SERVER["HTTP_HOST"]  Contient le nom de domaine du serveur
$_SERVER["HTTP_USER_AGENT"]  Contient le type de navigateur
$_SERVER["PATH_INFO"]  Contient  le chemin complet du script
$_SERVER["REQUEST_URI"]  Contient  le chemin du script à partir du répertoire racine
$_SERVER["REMOTE_ADDR"]  Contient l'adresseIP de l'internaute
$_SERVER["QUERY_STRING"] Contient la liste des paramètres passés dans l'URL
$_SERVER["SERVER_ADDR"]  Contient l'adresse IP du serveur
$_SERVER["SERVER_ADMIN"]  Contient l'adresse de l'administrateur du serveur mail@mail.com
$_SERVER["SERVER_NAME"]  Contient le nom local du serveur
$_SERVER["REQUEST_METHOD"]  Méthode d'appel du script GET
*/
//DETECTER l'OS de l'utilisateur
$user_agent = getenv("HTTP_USER_AGENT");

if (strpos($user_agent, "Win") !== FALSE)
    $os = "Windows";
elseif ((strpos($user_agent, "Mac") !== FALSE) || (strpos($user_agent, "PPC") !== FALSE))
    $os = "Mac";
elseif (strpos($user_agent, "Linux") !== FALSE)
    $os = "Linux";
elseif (strpos($user_agent, "FreeBSD") !== FALSE)
    $os = "FreeBSD";
elseif (strpos($user_agent, "SunOS") !== FALSE)
    $os = "SunOS";
elseif (strpos($user_agent, "IRIX") !== FALSE)
    $os = "IRIX";
elseif (strpos($user_agent, "BeOS") !== FALSE)
    $os = "BeOS";
elseif (strpos($user_agent, "OS/2") !== FALSE)
    $os = "OS/2";
elseif (strpos($user_agent, "AIX") !== FALSE)
    $os = "AIX";
else
    $os = "Autre";


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Un bon cookie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        if (document.body)
        {
            var larg = (document.body.clientWidth);
            var haut = (document.body.clientHeight);
        }

        else
        {
            // ne fonctionne pas avec ie
            var larg = (window.innerWidth);
            var haut = (window.innerHeight);
        }
    </script>
</head>
<body>

</body>
</html>