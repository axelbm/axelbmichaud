<?php

namespace app\controleurs;

class Connexion extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) > 0)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("connexion");
		
		$this->verifierUtilisateur();

		if ($this->estConnecter())
			\core\MainControleur::rediriger();


		$vue->afficher();


		return null;
	}

}
