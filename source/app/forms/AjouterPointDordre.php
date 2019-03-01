<?php

namespace app\forms;

use app\modeles;

class AjouterPointDordre extends \core\Form {
    public $reunionid;
    public $titre;
    public $description;
    public $dossierid;
    
    public function valider () {
        if ($this->reunionid == "") {
            $this->ajouterErreur("reunionid", "Réunion obligatoire");
        }
        if ($this->titre == "") {
            $this->ajouterErreur("titre", "Titre obligatoire");
        }
        
        $this->dossierid = intval($this->dossierid);
        $this->dossierid = $this->dossierid == 0 ? null : $this->dossierid;
        // if ($this->dossierid == "") {
        //     $this->ajouterErreur("dossierid", "Dossier obligatoire");
        // }
    }

    public function action() {
        $pointdordre = new modeles\PointDordre($this->reunionid, $this->titre, $this->description, $this->dossierid, "");
        $pointdordre->sauvegarder();

        \core\MainControleur::rediriger("detailsreunion/".$this->reunionid);
    }
}