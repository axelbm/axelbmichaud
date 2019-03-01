<?php

namespace app\controleurs;
use \core\DAO;

class ModifDossier extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) != 1)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("modifDossier");
		
		$this->verifierUtilisateur();

		if (!$this->estConnecter() && !$this->utilisateur->estAdministrateur())
            \core\MainControleur::rediriger();


        $dossier = null;

		$dossier = DAO::Dossier()->find($args[0]);
		if (!$dossier){
			return new \Exception("Parametre de recherche invalide", 404);
		}
            
        $vue->set("dossier", $dossier);

		$vue->afficher();


		return null;
	}

}