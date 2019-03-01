<?php

namespace app\forms;

use app\modeles;

class AjouterReunion extends \core\Form {
    public $date;
    public $heure;
    private $createur;
    
    public function valider () {
        if ($this->date == "") {
            $this->ajouterErreur("date", "Date obligatoire");
        }
        if ($this->heure == "") {
            $this->ajouterErreur("heure", "Heure obligatoire");
        }

        $datetime = $this->date." ".$this->heure;
        if (new \DateTime($datetime) < new \DateTime()) {
            $this->ajouterErreur("date", "La date ne peut être dépassée.");
        }
        $this->createur = \app\outils\Session::getUtilisateur()->getCourriel();
    }

    public function action() {
        $datetime = $this->date." ".$this->heure;

        $reunion = new modeles\Reunion(new \DateTime($datetime), $this->createur);
        $reunion->sauvegarder();

        $participation = new modeles\Participation($reunion->getId(), $this->createur, "Org");
        $participation->sauvegarder();

        \core\MainControleur::rediriger("detailsReunion", [$reunion->getId()]);
    }
}