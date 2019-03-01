<?php

namespace app\controleurs;
use \core\DAO;

class Dossiers extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) > 1)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("dossiers");
		
		$this->verifierUtilisateur();

		if (!$this->estConnecter())
			\core\MainControleur::rediriger("connexion");

		$page = isset($args[0]) ? $args[0] : 0;
		$nombre = isset($_GET["npp"]) && is_numeric($_GET["npp"]) ? $_GET["npp"] : null;
		$dossiers = array();

		if (is_numeric($page)){
			$page = intval($page);
		}else{
			return new \Exception("Parametre de recherche invalide", 404);
		}

		// if (isset($_GET["reunion"])) {
		// 	$reunion = DAO::Reunion()->find($_GET["reunion"]);
		// 	if (!$reunion){
		// 		return new \Exception("Parametre de recherche invalide", 404);
		// 	}
		// 	$dossiers = DAO::Dossier()->getListeParReunion(min(DAO::Dossier()->getPageParReunion($reunion, $nombre), $page), $reunion, $nombre);
		// }elseif(isset($_GET["nom"])){
		// 	$dossiers = DAO::Dossier()->getListeParNom(min(DAO::Dossier()->getPageParNom($_GET["nom"], $nombre), $page), $_GET["nom"], $nombre);
		// }else{
			$dossiers = DAO::Dossier()->getListe(min(DAO::Dossier($nombre)->getPage(), $page), $nombre);
			$nombredepage = DAO::Dossier()->getPage($nombre);
		//}

		$vue->set("page", $page);
		$vue->set("dossiers", $dossiers);
		$vue->set("nombredepage", $nombredepage);

		$vue->afficher();

		return null;
	}
}