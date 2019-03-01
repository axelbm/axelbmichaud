<?php

namespace app\forms;

use app\modeles;

class ModifCompteRendu extends \core\Form {
    public $compterendu;
    public $id;
    
    public function valider () {
        
    }

    public function action() {
        $pointdordre = \core\DAO::PointDordre()->find($this->id);
        $pointdordre->setCompteRendu($this->compterendu);
        $pointdordre->sauvegarder();
        
        \core\MainControleur::rediriger("detailspoints/".$pointdordre->getId());
    }
}