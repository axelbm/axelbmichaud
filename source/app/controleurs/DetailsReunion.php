<?php

namespace app\controleurs;
use \core\DAO;

class DetailsReunion extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) < 1 || count($args) > 2)
			return new \Exception("erraaaeur 404", 404);

		$vue = $this->genererVue("detailsReunion");
		
		$this->verifierUtilisateur();

		if (!$this->estConnecter())
			\core\MainControleur::rediriger("connexion");

        $reunion = DAO::Reunion()->find($args[0]);
       	if (!$reunion) {
			return new \Exception("erreur 404", 404);
		}
		
		if (isset($args[1])) {
			switch ($args[1]) {
				case 'ajouterpointdordre':
					$dossiers = DAO::Dossier()->select();
					$vue->set("dossiers", $dossiers);
					
					break;
				
				default:
					return new \Exception("erreur 404", 404);
			}
		}

		$reunion->mettreAJourStatut();
		   
		$pointdordres = $reunion->getPointDordres();
		$participants = DAO::Participation()->getParReunion($args[0]);

		$participation = DAO::Participation()->find($reunion->getId(), $this->utilisateur->getCourriel());

		$estcreateur = $reunion->estCreateur($this->utilisateur);
		
		$vue->set("ajouterPointDordre", isset($args[1]) && $args[1] == "ajouterpointdordre");
		$vue->set("reunion", $reunion);
		$vue->set("participants", $participants);
		$vue->set("participation", $participation);
		$vue->set("pointdordres", $pointdordres);
		$vue->set("estcreateur", $estcreateur);
		
		$vue->setJSVar("participation", $participation->getStatutID());

		$vue->afficher();


		return null;
	}

}