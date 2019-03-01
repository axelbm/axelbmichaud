<?php

namespace app\forms;

use app\modeles;

class AnnulerReunion extends \core\Form {
    public $statut;
    public $reunionid;

    /** @var \app\modeles\Reunion */
    private $reunion;
    
    public function valider () {
        $this->reunion = \core\DAO::Reunion()->find($this->reunionid);

        if (!$this->reunion) {
            $this->ajouterErreur("reunionid", "Reunion obligatoire");
            \app\outils\Notification::ajouterPopup("Erreur", "Il y a une erreur.");
        }
    }

    public function action() {
        $this->reunion->setStatutId("Ann");

        $this->reunion->sauvegarder();
        
        // \core\MainControleur::rediriger("detailsReunion", [$this->reunion->getId()]);
    }
}