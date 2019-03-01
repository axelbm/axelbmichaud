<?php

namespace app\forms;

use core\DAO;

class Connexion extends \core\Form {
    /** @var string */
    public $courriel;
    /** @var string */
    public $motDePasse;
    /** @var string */
    public $resterConnecter = 'off';

    public function valider (){
        $resultat = true;

        if (!$this->validerChamp("Courriel", $this->courriel)) {
            $this->ajouterErreur("courriel", "Courriel invalide");
            $resultat = false;
        }

        if ($this->motDePasse == "") {
            $this->ajouterErreur("motDePasse", "Mot de passe obligatoire");
            $resultat = false;
        }

        if ($resultat) {     
            $this->utilisateur = DAO::Utilisateur()->find($this->courriel);

            if ($this->utilisateur == NULL) {  
                $this->ajouterErreur("courriel", "Utilisateur inexistant");
            }
            elseif (!$this->utilisateur->validerMotDePasse($this->motDePasse)) {
                $this->ajouterErreur("motDePasse", "Mot de passe incorrect");
            }
        }
    }

    public function action() {
        \app\outils\Session::connexion($this->utilisateur, $this->resterConnecter == 'on');

        \core\MainControleur::rediriger();
    }
}