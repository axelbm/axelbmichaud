<?php

namespace app\controleurs;
use \core\DAO;

class AjoutParticipation extends \core\Controleur {
	use atraits\Utilisateur;

	public function action(array $args) : ?\Exception {
		if (count($args) != 1)
			return new \Exception("erreur 404", 404);

		$vue = $this->genererVue("ajoutParticipation");
		
		$this->verifierUtilisateur();

		if ($this->estConnecter() && !$this->utilisateur->estAdministrateur())
			\core\MainControleur::rediriger();


        $reunion = DAO::Reunion()->find($args[0]);
        if (!$reunion) {
            return new \Exception("erreur 404", 404);
        }
        
        $utilisateurs = DAO::Utilisateur()->listeInvitation($reunion);

        $vue->set("reunion", $reunion);
		$vue->set("utilisateurs", $utilisateurs);

		$vue->afficher();


		return null;
	}

}
