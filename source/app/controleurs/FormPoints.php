<?php

namespace app\controleurs;
use \core\DAO;

class FormPoints extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) != 1)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("formPoints");
		
		$this->verifierUtilisateur();

		if (!$this->estConnecter())
			\core\MainControleur::rediriger();
			
		$reunion = DAO::Reunion()->find($args[0]);
		if (!$reunion) {
			return new \Exception("erreur 404", 404);
		}

		$dossiers = DAO::Dossier()->select();

		$vue->set("dossiers", $dossiers);
		$vue->set("reunion", $reunion);
            
		$vue->afficher();


		return null;
	}

}