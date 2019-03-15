<?php

namespace app\forms\admin;

use core\DAO;
use core\Util;
use core\Config;
use app\outils\Admin;
use app\outils\Database;
use core\MainControleur;

class ConnexionDatabase extends \core\Form {
    /** @var string */
    public $host;
    /** @var int */
    public $port = 3306;
    /** @var string */
    public $table;
    /** @var string */
    public $identifiant;
    /** @var string */
    public $motDePasse;

    public function valider (){
        $this->port = is_numeric($this->port) ? intval($this->port) : null;

        if (!Admin::estConnecter()) {
            $this->ajouterErreur("global", "Vous n'êtes pas administrateur.");
            return;
        }

        if ($err = Database::verifier($this->host, $this->port, $this->table, $this->identifiant, $this->motDePasse)) {

            switch ($err->getCode()) {
                case 1045:
                    $this->ajouterErreur("identifiant", "Accès refusé.");
                    $this->ajouterErreur("motDePasse", " ");
                    break;
                
                case 1049:
                    $this->ajouterErreur("table", "Base de données inconue.");
                    break;
                
                case 2002:
                    $this->ajouterErreur("host", "Hôte inconnue.");
                    $this->ajouterErreur("port", " ");
                    break;
                
                default:
                    $this->ajouterErreur("host", $th->getCode().": ".$th->getMessage());
                    $this->ajouterErreur("port", " ");
                    $this->ajouterErreur("table", " ");
                    $this->ajouterErreur("identifiant", " ");
                    $this->ajouterErreur("motDePasse", " ");
                    break;
            }
        }
    }

    public function action() {
        Database::sauvegarder($this->host, $this->port || 3306, $this->table, $this->identifiant, $this->motDePasse);
    }
}