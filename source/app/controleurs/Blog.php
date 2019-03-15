<?php

namespace app\controleurs;

use \app\modeles;
use core\Controleur;
use exceptions\Erreur404;

class Blog extends Controleur {
	use atraits\Utilisateur;

	/** @var \app\dao\Blog */
	private $dao;

	

	public function action(array $args) : ?\Exception {
		$this->dao = new \app\dao\Blog();

		if ($this->route("")) {
			return $this->liste();
		}
		elseif ($this->route("Blog:blog")) {
			return $this->afficher($this->blog);
		}
		elseif ($this->route("nouveau")) {
			return $this->nouveau();
		}
		elseif ($this->route("modifier/Blog:blog")) {
			return $this->modifier($this->blog);
		}
		
		return new Erreur404();
	}


	
	private function liste() : ?\Exception {
		$vue = $this->genererVue("blog/liste");

		$blogs = $this->dao->getListe();
		$tags = $this->dao->getTags();
		
		$this->verifierUtilisateur();

		$vue->set("blogs", $blogs);
		$vue->set("tags", $tags);

		$vue->afficher();

		return null;
	}
	
	private function afficher(modeles\Blog $blog) : ?\Exception {
	 	$vue = $this->genererVue("blog/afficher");
			
		$this->verifierUtilisateur();

		$vue->set("blog", $blog);

		$vue->afficher();

		return null;
	}
	
	private function modifier(modeles\Blog $blog) : ?\Exception {
		$vue = $this->genererVue("blog/modifier");
			
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
	}

	private function nouveau() : ?\Exception {
		$vue = $this->genererVue("blog/nouveau");
			
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
	}
}
