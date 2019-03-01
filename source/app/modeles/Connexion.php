<?php

namespace app\modeles;

use \core\Modele;


class Connexion extends Modele {
    /** @var string */
    protected $courriel;
    
    /** @var \DateTime */
    protected $date;

    /** @var string */
    protected $cle;
    
    public function __construct(string $courriel=null, \DateTime $date=null, string $cle=null) {
        if (is_null($date))
            $date = new \DateTime();

        $this->courriel = $courriel;
        $this->date= $date;
        $this->cle = $cle;
    }

    public function genererCle() : string {
        $this->cle = \core\Util::randomKey(32);
        return $this->cle;
    }
}