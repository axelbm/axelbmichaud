<?php

namespace app\controleurs;

class NousContacter extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) > 0)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("nouscontacter");
			
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
	}
}
