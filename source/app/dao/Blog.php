<?php

namespace app\dao;

use \core\DAO;
use \app\modeles;

class Blog extends DAO {
    protected $table = "blogs";

    protected $proprietes = [
        "Id" => "blogid:integer:PK,AI",
        "AuteurCourriel" => "auteur:string",
        "Titre" => "titre:string",
        "Resume" => "resume:string",
        "Contenu" => "contenu:string",
        "Publication" => "publication:DateTime",
        "Modification" => "modification:DateTime",
        "Categorie" => "categorie:string",
        "Tags" => "tags:array",

        "Auteur" => "AuteurCourriel:Utilisateur:FK:courriel"
    ];
}
