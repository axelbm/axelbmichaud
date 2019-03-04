<?php

namespace app\controleurs;

use exceptions\Erreur404;

class Projet extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if ($this->route("")) {
			return $this->liste();
        }
        
        self::executer("Blog", $args);
	}



	private function liste() : ?\Exception {
		$vue = $this->genererVue("projets");
		
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
    }
}