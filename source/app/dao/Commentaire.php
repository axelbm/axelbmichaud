<?php

namespace app\dao;

use \core\DAO;
use \app\modeles;

class Commentaire extends DAO {
    protected $table = "blogs";

    protected $proprietes = [
        "Id" => "commentaireid:integer:PK,AI",
        "AuteurCourriel" => "auteur:string",
        "Contenu" => "contenu:string",
        "Publication" => "publication:DateTime",
        "ParentId" => "parent:int",
        "ParentType" => "parent_type:string",

        "Auteur" => "AuteurCourriel:Utilisateur:FK:courriel"
    ];


    public function getCommentairesParBlog(modeles\Blog $blog) : array {
        return $this->select("WHERE parent=? AND parent_type=?", $blog->getId(), $blog->dao()->getTable());
    }


    public function getCommentairesParCommentaire(modeles\Commentaire $commentaire) : array {
        return $this->select("WHERE parent=? AND parent_type=?", $commentaire->getId(), $commentaire->dao()->getTable());
    }
}
