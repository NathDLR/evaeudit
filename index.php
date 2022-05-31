
<!--<label>Site bientôt disponible !</label>
<br>
<label>Website coming soon !</label>
<br>
<a href="https://www.certification-vegan.org/fr/">Home</a>-->
<?php
/*die();*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

if(!isset($_SESSION)){
    session_start();
}

$_SESSION['Disable_creation'] = 0;

const Version = 'V1-01.09.2021';

require_once 'vendor/spyc/Spyc.php';

if(empty($_COOKIE['lang'])){
    setcookie('lang', 'en', time() + (365 * 24 * 60 * 60), '/audit-admin/');
    define('lang', Spyc::YAMLLoad("language/messages.en.yaml"));
}else{
    switch ($_COOKIE['lang']){
        case 'fr':
        case 'en':
            define('lang', Spyc::YAMLLoad("language/messages." . $_COOKIE['lang'] . ".yaml"));
            break;
        default:
            setcookie('lang', 'en', time() + (365 * 24 * 60 * 60), '/audit-admin/');
            define('lang', Spyc::YAMLLoad("language/messages.en.yaml"));
            break;
    }
}

/* Constante de la page index.php par défaut */
$server = isset($_SERVER['HTTPS']) ? "https" : "http";
define('URL', str_replace("index.php", "", ($server."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]")));

/* Pour définir un chemin pour revenir à l'index faire dans la view : <?php echo URL; ?> */
require_once('controllers/Router.php');
$router = new Router();


echo $router->routeRequest();


