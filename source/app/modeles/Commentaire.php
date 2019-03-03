<?php

namespace app\modeles;

use \core\Modele;

class Commentaire extends Modele {

    /** @var int */
    protected $commentaire;
    
    /** @var string */
    protected $auteur;
    
    /** @var string */
    protected $contenu;

    /** @var \DateTime */
    protected $publication;
    
    /** @var int */
    protected $parent;
    
    /** @var string */
    protected $parent_type;


    public  function __construct(string $auteur="", string $contenu="",  
                                 \DateTime $publication=null,
                                 int $parent="", string $parent_type="") {

        if (is_null($publication))
            $publication = new \DateTime();

        $this->auteur = $auteur;
        $this->contenu = $contenu;
        $this->publication = $publication;
        $this->parent = $parent;
        $this->parent_type = $parent_type;
    }

    public function getCommentaires() : array {
        return \core\DAO::Commentaire->getCommentairesParCommenataire($this);
    }

    public function modifier(modeles\Utilisateur $utilisateur, string $titre, string $contenu) {
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->modification = new \DateTime();
    }
}
