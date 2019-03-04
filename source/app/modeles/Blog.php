<?php

namespace app\modeles;

use \core\Modele;

class Blog extends Modele {

    /** @var int */
    protected $blogid;
    
    /** @var string */
    protected $auteur;
    
    /** @var string */
    protected $modificateur;
    
    /** @var string */
    protected $titre;
    
    /** @var string */
    protected $resume;
    
    /** @var string */
    protected $contenu;

    /** @var \DateTime */
    protected $publication;

    /** @var \DateTime */
    protected $modification;
    
    /** @var string */
    protected $categorie;
    
    /** @var array */
    protected $tags;


    public  function __construct(string $auteur="", string $titre="", string $resume="", string $contenu="",  
                                 \DateTime $publication=null, \DateTime $modification=null,  
                                 string $categorie="", array $tags=[]) {

        if (is_null($publication))
            $publication = new \DateTime();

        $this->auteur = $auteur;
        $this->titre = $titre;
        $this->resume = $resume;
        $this->contenu = $contenu;
        $this->publication = $publication;
        $this->modification = $modification;
        $this->categorie = $categorie;
        $this->tags = $tags;
    }

    public function getCommentaires() : array {
        return \core\DAO::Commentaire()->getCommentairesParBlog($this);
    }

    public function modifier(modeles\Utilisateur $utilisateur, string $titre, string $contenu) {
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->modification = new \DateTime();
    }
}
