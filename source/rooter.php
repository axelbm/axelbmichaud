<?php

date_default_timezone_set ("America/New_York");

require "config_systeme.php";
require "config_site.php";

// Charge le Autoloader pour charger automatiquement les fichiers des classes
require COREROOT."AutoLoader.php";
spl_autoload_register("core\AutoLoader::loader");

// Connection a la base de données a l'aide des configs
try {
    core\Database::connect(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
} catch (\Throwable $th) {
    core\MainControleur::executerErreur(new \Exception("Base de données inaccessible...", 500));
}

// Initialisation de la session
session_start();
core\Session::initializer();

// Analyse du formulaire
core\MainForm::trouverForm();

// Extrait les paramettre du url
$params = explode('/', $_GET['params']);
$action = array_shift($params);

// Si il n'y a aucun action, l'action par defaut va etre chargé
if ($action == "") {
    $action = ACCUEIL;
}
// Bypass le controleur pour les tests
elseif ($action == "_test") {
    $action = array_shift($params);

    require "test/$action.php";

    exit();
}

// Charge le controleur
$ctrl = core\MainControleur::executer($action, $params);