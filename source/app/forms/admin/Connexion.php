<?php

namespace app\forms\admin;

use core\DAO;
use core\Util;
use core\Config;
use app\outils\Admin;
use core\MainControleur;

class Connexion extends \core\Form {
    /** @var string */
    public $identifiant;
    /** @var string */
    public $motDePasse;

    public function valider (){
        $resultat = true;
        
        if (!Admin::verifierInformation($this->identifiant, $this->motDePasse)) {
            $this->ajouterErreur("identifiant", "Identifiant ou mot de passe invalide.");
            $this->ajouterErreur("motDePasse", " ");
        }

        $this->motDePasse = "";
    }

    public function action() {
        Admin::seConnecter($this->identifiant);

        MainControleur::rediriger("admin", $_SESSION["page_apres_connexion"]);
    }
}