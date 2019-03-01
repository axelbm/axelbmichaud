<?php

namespace app\controleurs;
use \core\DAO;

class Calendrier extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) > 1)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("calendrier");
		
		$this->verifierUtilisateur();

		if (!$this->estConnecter())
			\core\MainControleur::rediriger("connexion");

		$page = isset($args[0]) ? $args[0] : 0;
		$nombre = isset($_GET["npp"]) && is_numeric($_GET["npp"]) ? $_GET["npp"] : null;
		$reunions = array();

		if (is_numeric($page)){
			$page = intval($page);
		}else{
			return new \Exception("Parametre de recherche invalide", 404);
		}

		$reunions = DAO::Reunion()->getListeParUtilisateur(min(DAO::Reunion()->getPageParUtilisateur($this->utilisateur, $nombre), $page), $this->utilisateur, $nombre);
		
		$participations = [];
		foreach ($reunions as $reunion) {
			$participations[$reunion->getId()] = DAO::Participation()->find($reunion->getId(), $this->utilisateur->getCourriel())->getStatutID();
		}

		$nombredepage = DAO::Reunion()->getPageParUtilisateur($this->utilisateur, $nombre);

		$estadmin = $this->utilisateur->estAdministrateur();
		
		$vue->set("page", $page);
		$vue->set("reunions", $reunions);
		$vue->set("participations", $participations);
		$vue->set("nombredepage", $nombredepage);
		$vue->set("estadmin", $estadmin);

		
		$vue->setJSVar("participations", $participations);

		$vue->afficher();


		return null;
	}

}