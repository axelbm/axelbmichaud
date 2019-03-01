<?php

namespace app\modeles;

use \core\Modele;

use \app\dao\Invitation as dao;

class Invitation extends Modele {
    /** @var string */
    protected $courriel;
    
    /** @var string */
    protected $cle;

    public function validerCle (string $cleV) : bool {
        return $cleV == $this->cle;
    }

    public function __construct(string $courriel="", string $cle="") {
        $this->courriel = $courriel;
        $this->cle = $cle;
    }

    public function genererCle() : string {
        $this->cle = \core\Util::randomKey(32);
        return $this->cle;
    }
}