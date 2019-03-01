<?php

namespace app\controleurs;

class FormDossier extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) > 0)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("formDossier");
		
		$this->verifierUtilisateur();

		if (!$this->estConnecter() && !$this->utilisateur->estAdministrateur())
            \core\MainControleur::rediriger();
            
		$vue->afficher();


		return null;
	}

}