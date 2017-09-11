<?php
// require "../Vendors/autoload.php";
// use Config;

require "../Config/core.php";
require "../Config/configuration.php";
require "../dispatcher.php";
require "../Src/router.php";
require "../Src/formValidator.php";
require "../Src/session.php";
require "../Config/database.php";
require "../Controllers/AppController.php";
require "../twigloader.php";
require "../Models/Objects/User.php";

$core = new Core($_SERVER["REQUEST_URI"]);
$core->run();

?>
