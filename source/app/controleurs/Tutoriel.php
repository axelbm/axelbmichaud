<?php

namespace app\controleurs;

class Tutoriel extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) == 0) {
			return $this->liste();
        }
        
        self::executer("Blog", $args);
	}



	private function liste() : ?\Exception {
		$vue = $this->genererVue("tutoriel");
		
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
    }
}