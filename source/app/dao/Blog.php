<?php

namespace app\dao;

use \core\DAO;
use \app\modeles;
use core\Database;

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

        "Auteur" => "AuteurCourriel:Utilisateur:FK,S:courriel"
    ];

    /**
     * Retourne un liste de blogs.
     * 
     * int "page" - la n em page.
     * int "npp" - le nombre de blog par page.
     * string "tags" (tag séparé par des virgule) - des tags de recherche.
     * string "recherche" - recherche par nom, tags ou par auteur.
     * string "ordre" (date, nom, vue, commentaire)
     *
     * @param array $option 
     * @return array
     */
    public function getListe(array $option=[]) : array {
        $option["categorie"] = isset($option["categorie"]) ? $option["categorie"] : "blog";
        
        return $this->select("WHERE categorie=?", $option["categorie"]);
    }

    
    public function getTags(?string $categorie="blog") : array {
        $stmt = Database::query("SELECT tags FROM blogs WHERE categorie=?", $categorie);

        $resultTags = [];
        $passedTags = [];

        while ($result = $stmt->fetchColumn()) {
            $tags = explode(",", $result);

            foreach ($tags as $tag) {
                $tag = trim($tag);

                if (!isset($passedTags[$tag])) {
                    $passedTags[$tag] = true;
                    array_push($resultTags, $tag);
                }
            }
        }

        return $resultTags;
    }


    
}