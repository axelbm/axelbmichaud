<?php

namespace app\forms;

use app\modeles;

class AjouterDossier extends \core\Form {
    public $nom;
    public $description;
    
    public function valider () {
        if ($this->nom == "") {
            $this->ajouterErreur("nom", "Nom obligatoire");
        }
    }

    public function action() {
        $dossier = new modeles\Dossier($this->nom, $this->description);
        $dossier->sauvegarder();

        \core\MainControleur::rediriger("detailsdossier", [$dossier->getId()]);
    }
}