<?php

namespace app\modeles;

use \core\Modele;

use \app\dao\PointDordre as dao;

class PointDordre extends Modele {
    /** @var int */
    protected $pointdordreid;
    
    /** @var int */
    protected $reunionid;
    
    /** @var string */
    protected $titre;
    
    /** @var string */
    protected $description;
    
    /** @var int */
    protected $dossierid;
    
    /** @var string */
    protected $compterendu;

    public function __construct(?int $reunionid=0, ?string $titre="", ?string $description="", ?int $dossierid=null, ?string $compterendu="") {
        $this->reunionid = $reunionid;
        $this->titre = $titre;
        $this->description = $description;
        $this->dossierid = $dossierid;
        $this->compterendu = $compterendu;
    }
}
