<?php

namespace app\forms;

use app\modeles;

class ChangementStatut extends \core\Form {
    public $statut;
    public $reunionid;
    
    public function valider () {
        if ($this->reunionid == "") {
            $this->ajouterErreur("reunionid", "Reunion obligatoire");
        }
    }

    public function action() {
        $participation = \core\DAO::Participation()->find($this->reunionid, \app\outils\Session::getUtilisateur()->getCourriel());
        $participation->setStatutID($this->statut);
        $participation->sauvegarder();
    }
}