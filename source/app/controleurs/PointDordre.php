<?php

namespace app\controleurs;
use \core\DAO;

class PointDordres extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) > 1)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("pointdordres");
		
		$this->verifierUtilisateur();

		if (!$this->estConnecter())
			\core\MainControleur::rediriger("connexion");

		$page = isset($args[0]) ? $args[0] : 0;
		$nombre = isset($_GET["npp"]) && is_numeric($_GET["npp"]) ? $_GET["npp"] : null;
		$pointdordres = array();

		if (is_numeric($page)){
			$page = intval($page);
		}else{
			return new \Exception("Parametre de recherche invalide", 404);
		}

		if (isset($_GET["reunion"]))
            $pointdordres = DAO::PointDordre()->getListeParTitre(min(DAO::PointDordre()->getPage($_GET["titre"], $nombre), $page), $_GET["titre"], $nombre);
		else
			return new \Exception("Parametre de recherche invalide", 404);
			
		$nombredepage = DAO::Reunion()->getPageParUtilisateur($this->utilisateur, $nombre);

		$vue->set("page", $page);
		$vue->set("pointdordres", $pointdordres);
		$vue->set("nombredepage", $nombredepage);

		$vue->afficher();

		return null;
	}
}