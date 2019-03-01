<?php

namespace app\dao;

use \core\DAO;
use \app\modeles;

class Utilisateur extends DAO {
    protected $table = "utilisateurs";

    protected $proprietes = array(
        "Courriel" => "courriel:string:PK",
        "Nom" => "nom:string",
        "Prenom" => "prenom:string",
        "MotDePasse" => "motdepasse:string",
        "Administrateur" => "administrateur:integer",
        
        "Participations" => "Courriel:Participation:FK:courriel"
    );


    public function obtenirAdministrateurs() : array {
        return $this->select("WHERE administateur >= 1");
    }

    public function obtenirSuperAdministrateurs() : array {
        return $this->select("WHERE administateur = 2");
    }

    public function recherche(string $nom) : array{
        return $this->select("WHERE CONTAINS((nom + ' ' + prenom, prenom + ' ' + nom, courriel), ?)", $nom);
    }

    public function listeInvitation(modeles\Reunion $reunion) : array{
        $result = \core\Database::query("SELECT courriel, nom, prenom FROM utilisateurs WHERE courriel not in (select courriel from participations where reunionid = ?)", $reunion->getId());
        
        $utilisateurs = [];
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            array_push($utilisateurs, [
                "courriel" => $row["courriel"],
                "nom" => $row["prenom"] . " " . $row["nom"]
            ]);
        }

        return $utilisateurs;
    }

    public function getParCleDeConnexion(string $cle) : ?modeles\Utilisateur {
        return $this->selectFirst("INNER JOIN connexions ON utilisateurs.courriel = connexions.courriel
            WHERE connexions.cle = ?", $cle);
    }
}
