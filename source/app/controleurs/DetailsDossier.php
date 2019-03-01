<?php

namespace app\controleurs;
use \core\DAO;

class DetailsDossier extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) < 1 || count($args) > 2)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("detailsDossier");
		
		$this->verifierUtilisateur();

		if (!$this->estConnecter())
			\core\MainControleur::rediriger("connexion");

        $dossier = DAO::Dossier()->find($args[0]);
       	if (!$dossier) {
    		return new \Exception("erreur 404", 404);
		}
		
		if (isset($args[1]) && $args[1] != "editer")
			return new \Exception("erreuraaa 404", 404);
		   
       	$pointdordres = $dossier->getPointDordres();

		// $vue->set("reunions", $reunions);
		$vue->set("editer", isset($args[1]) && $args[1] == "editer");
		$vue->set("pointdordres", $pointdordres);
        $vue->set("dossier", $dossier);

		$vue->afficher();


		return null;
	}

}