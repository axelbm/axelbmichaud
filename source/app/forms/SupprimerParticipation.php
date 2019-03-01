<?php

namespace app\forms;

use app\modeles;
use core\DAO;

class SupprimerParticipation extends \core\Form {
    public $reunionid;
    public $courriel;

    /** @var modeles\Participation */
    private $participation;


    public function valider () {
        $this->reunionid = is_numeric($this->reunionid) ? intval($this->reunionid) : 0;

        $this->participation = DAO::Participation()->find($this->reunionid, $this->courriel);

        
        if (is_null($this->participation)) {
            $this->ajouterErreur("participation", "");
            \app\outils\Notification::ajouterPopup("Erreur", "Il y a eu un problème.<br>Veuillez réessayer plus tard.<br>[participation]",["tail"=>"sm"]);
        }


        $utilisateur = \app\outils\Session::getUtilisateur();
        $reunion = DAO::Reunion()->find($this->reunionid);

        if (is_null($reunion)) {
            \app\outils\Notification::ajouterPopup("Erreur", "Il y a eu un problème.<br>Veuillez réessayer plus tard.<br>[reunion]",["tail"=>"sm"]);
            $this->ajouterErreur("reunionid", "");
        }

        if (is_null($utilisateur)) {
            $this->ajouterErreur("utilisateur", "");
            \app\outils\Notification::ajouterPopup("Erreur", "Il y a eu un problème.<br>Veuillez réessayer plus tard.<br>[utilisateur]",["tail"=>"sm"]);
        }

        if ($reunion->getCreateur() != $utilisateur->getCourriel()) {
            $this->ajouterErreur("reunionid", "");
            \app\outils\Notification::ajouterPopup("Erreur", "Vous n'avez pas accès à cette fonctionnalité.",["tail"=>"sm"]);
        }

        if ($this->courriel == "") {
            $this->ajouterErreur("courriel", "");
            \app\outils\Notification::ajouterPopup("Erreur", "Il y a eu un problème.<br>Veuillez réessayer plus tard.<br>[courriel]",["tail"=>"sm"]);
        }

        
    }

    public function action() {
        $this->setAjax("nom", $this->participation->getUtilisateur()->getNomComplet());
        
        $this->participation->supprimer();
    }
}