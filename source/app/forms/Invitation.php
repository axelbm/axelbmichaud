<?php

namespace app\forms;

use app\modeles;

class Invitation extends \core\Form {
    public $courriel;
    
    public function valider () {
        if (!$this->validerChamp("Courriel", $this->courriel)) {
            $this->ajouterErreur("courriel", "Courriel obligatoire.");
        }
        elseif(\core\DAO::Utilisateur()->find($this->courriel)){
            $this->ajouterErreur("courriel", "Ce courriel a déjà été inscrit.");
        }
        elseif(\core\DAO::Invitation()->find($this->courriel)){
            $this->ajouterErreur("courriel", "Ce courriel a déjà reçu une invitation.");
        }
    }

    public function action() {
        $invitation = new modeles\Invitation($this->courriel);
        $invitation->genererCle();
        $invitation->sauvegarder();

        \app\outils\Notification::ajouterPopup("Succes", "Une invitation a bien été envoyé à $this->courriel.<br>
            <a href=\"".WEBROOT."inscription?cle=".$invitation->getCle()."\">S'inscrire</a>", ["tail"=>"sm"]);

        \core\MainControleur::rediriger();
    }
}