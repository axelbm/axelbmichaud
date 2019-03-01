<?php

namespace app\outils;

use \app\modeles\Utilisateur;
use \app\modeles\Connexion;
use \core\DAO as DAO;


class Session extends \core\Session {


    static public function getUtilisateur() : ?Utilisateur {
        if (isset($_SESSION["utilisateur"])){
            return DAO::Utilisateur()->find($_SESSION["utilisateur"]);
        } elseif (isset($_COOKIE["connexion"])) {
            if ($u = DAO::Utilisateur()->getParCleDeConnexion($_COOKIE["connexion"])) {
                self::connexion($u, true);
                return $u;
            }
        }

        return null;
    } 

    static public function connexion(Utilisateur $utilisateur, ?bool $resterCon=false) {
        
        $_SESSION["utilisateur"] = $utilisateur->getCourriel();

        $connexion = DAO::Connexion()->nouvelleConnexion($utilisateur);
        if ($resterCon) {
            $cle = $connexion->genererCle();
            setcookie("connexion", $cle, time()+60*60*24*7);
        }

        $connexion->sauvegarder();
    }

    static public function deconnexion(){
        if ($u = self::getUtilisateur()) {
            if ($c = DAO::Connexion()->find($u->getCourriel())) {
                $c->setCle("");
                $c->sauvegarder();
                setcookie("connexion", null);
            }
        }
        
        unset($_SESSION["utilisateur"]);
    }
}