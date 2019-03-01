<?php

namespace app\dao;

use \core\DAO;
use \app\modeles;

class Connexion extends DAO {
    protected $table = "connexions";

    protected $proprietes = array(
        "Courriel" => "courriel:string:PK",
        "Date" => "date:DateTime",
        "Cle" => "cle:string"
    );

    public function nouvelleConnexion(modeles\Utilisateur $utilisateur) : modeles\Connexion {
        if ($c = $this->find($utilisateur->getCourriel())) {
            $c->setDate(new \DateTime());
            $c->setCle("");
            return $c;
        }
        else {
            return new modeles\Connexion($utilisateur->getCourriel());
        }
    }
}