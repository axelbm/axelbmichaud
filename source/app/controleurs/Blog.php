<?php

namespace app\controleurs;

class Blog extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) == 0) {
			return $this->liste();
		}
		elseif (count($args) == 1) {
			if (\is_numeric($args[0])) {
				return $this->afficher(intval($args[0]));
			}
			elseif ($args[0] == "nouveau") {
				return $this->nouveau();
			}
		}
		elseif (count($args) == 2) {
			if ($args[0] == "modifier" && \is_numeric($args[1])) {
				return $this->modifier(intval($args[1]));
			}
		}
		
		return new \Exception("erreur 404", 404);
	}



	private function liste() : ?\Exception {
		$vue = $this->genererVue("blog/liste");
		
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
	}
	
	private function afficher(int $id) : ?\Exception {
		$vue = $this->genererVue("blog/afficher");
			
		$this->verifierUtilisateur();

		$vue->afficher();

		return null;
	}
	
	private function modifier(int $id) : ?\Exception {
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
