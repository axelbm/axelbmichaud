<?php

namespace app\controleurs;

class SuperAdmin extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) > 0)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("superAdmin");
		
		$this->verifierUtilisateur();

		if (!$this->estConnecter() && !$this->utilisateur->estSuperAdministrateur())
            \core\MainControleur::rediriger();
            
		$vue->afficher();


		return null;
	}

}