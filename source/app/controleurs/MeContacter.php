<?php

namespace app\controleurs;

class MeContacter extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
			return new \Exception("erreur 404", 404);
		if ($this->route(""))

		$vue = $this->genererVue("accueil");
			
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
	}
}
