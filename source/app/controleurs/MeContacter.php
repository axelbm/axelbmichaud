<?php

namespace app\controleurs;

use exceptions\Erreur404;

class MeContacter extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if ($this->route(""))
			return new Erreur404();

		$vue = $this->genererVue("accueil");
			
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
	}
}
