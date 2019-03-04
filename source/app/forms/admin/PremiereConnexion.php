<?php

namespace app\forms\admin;

use core\DAO;
use core\Util;
use core\Config;
use app\outils\Admin;
use core\MainControleur;

class PremiereConnexion extends \core\Form {
    /** @var string */
    public $code;
    /** @var string */
    public $identifiant;
    /** @var string */
    public $motDePasse;

    public function valider (){
        $resultat = true;

        $cfg = Config::charger("code_secret.p");
        if (!$cfg || $cfg->code_secret != $this->code) {
            $this->ajouterErreur("code", "Code invalide.");
        }
        
        if (strlen($this->identifiant) < 4) {
            $this->ajouterErreur("identifiant", "Identifiant invalide.");
        }

        if (!$this->validerChamp("MotDePasse", $this->motDePasse)) {
            $this->ajouterErreur("motDePasse", "Mot de passe est invalide.");
        }
    }

    public function action() {
        Admin::ajouterAdmin($this->identifiant, $this->motDePasse);

        Config::supprimerFichier("code_secret.p");

        MainControleur::rediriger("admin", ["acces", "connexion"]);
    }
}