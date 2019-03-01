<?php

namespace app\modeles;

use \core\Modele;

use \app\dao\Dossier as dao;

class Dossier extends Modele {
    /** @var int */
    protected $id;
    
    /** @var string */
    protected $nom;

    /** @var string */
    protected $description;

    public function __construct(string $nom="", string $description="") {
        $this->nom = $nom;
        $this->description = $description;
    }
}