<?php

namespace app\controleurs;

class Blog extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
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
		
		return new \Exception("erreur 404", 404);
	}



	private function liste() : ?\Exception {
		$vue = $this->genererVue("blog/liste");
		
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
	}
	
	private function afficher(modeles\Blog $blog) : ?\Exception {
		$vue = $this->genererVue("blog/afficher");
			
		$this->verifierUtilisateur();

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
