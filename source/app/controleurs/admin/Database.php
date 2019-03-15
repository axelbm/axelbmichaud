<?php

namespace app\controleurs\admin;

use exceptions\Erreur404;
use exceptions\PasImplementer;

class Database extends \core\Controleur {

    public function action(array $args) : ?\Exception {
        if ($this->route("connexion")) {
            return $this->connexion();
        }

        return new Erreur404();
    }


    public function connexion() : ?\Exception {
        $vue = $this->genererVue("admin/database/connexion");
			
        $vue->setDisposition("admin");
        
		$vue->afficher();

		return null;
    }
}