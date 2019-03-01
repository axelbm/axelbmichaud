<?php

namespace app\controleurs;
use \core\DAO;

class ReunionCreee extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) > 1)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("reunionCreee");
		
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

		$estadmin = $this->utilisateur->estAdministrateur();
		if ($estadmin){
			$reunions = DAO::Reunion()->getListeParCreateur(min(DAO::Reunion()->getPageParCreateur($this->utilisateur, $nombre), $page), $this->utilisateur, $nombre);
		}else{
            \core\MainControleur::rediriger();
        }

		$nombredepage = DAO::Reunion()->getPageParCreateur($this->utilisateur, $nombre);

		$vue->set("page", $page);
		$vue->set("reunions", $reunions);
		$vue->set("nombredepage", $nombredepage);

		$vue->afficher();


		return null;
	}

}