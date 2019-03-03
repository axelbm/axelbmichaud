<?php

namespace app\controleurs;

class MeContacter extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) > 0)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("accueil");
			
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
	}
}
