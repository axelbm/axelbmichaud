<?php

namespace app\outils;

use \app\modeles\Utilisateur as mUtilisateur;
use \app\modeles\Connexion;
use \core\DAO as DAO;


class Utilisateur {
    /** @var \app\modeles\Utilisateur */
    static private $utilisateur;

    static public function getUtilisateur() : ?mUtilisateur {
        if (is_null(self::$utilisateur)) {
            if (isset($_SESSION["utilisateur"])){
                self::$utilisateur = DAO::Utilisateur()->find($_SESSION["utilisateur"]);

                return self::$utilisateur;
            } elseif (isset($_COOKIE["connexion"])) {
                if ($u = DAO::Utilisateur()->getParCleDeConnexion($_COOKIE["connexion"])) {
                    self::seConnecter($u, true);

                    self::$utilisateur = $u;

                    return $u;
                }
            }
        }
        else {
            return self::$utilisateur;
        }

        return null;
    } 

    static public function seConnecter(Utilisateur $utilisateur, ?bool $resterCon=false) {
        
        $_SESSION["utilisateur"] = $utilisateur->getCourriel();

        $connexion = DAO::Connexion()->nouvelleConnexion($utilisateur);
        if ($resterCon) {
            $cle = $connexion->genererCle();
            setcookie("connexion", $cle, time()+60*60*24*7);
        }

        $connexion->sauvegarder();
    }

    static public function seDeconnecter(){
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