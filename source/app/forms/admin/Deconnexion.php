<?php

namespace app\forms\admin;

use core\DAO;
use core\Util;
use core\Config;
use app\outils\Admin;
use core\MainControleur;

class Deconnexion extends \core\Form {
    /** @var string */
    public $identifiant;
    /** @var string */
    public $motDePasse;

    public function valider (){
    }

    public function action() {
        Admin::seDeconnecter();

        MainControleur::rediriger();
    }
}