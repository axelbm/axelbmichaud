<?php 

namespace app\outils;

use core\Util;
use core\Config;
use app\outils\Notification;

final class Admin {
    static private $chemin = "administrateurs.p";
    static private $fichier;

    static public function estConnecter() : bool {
        if(isset($_SESSION["administrateur"])) {
            if (time() > $_SESSION["administrateur"]["expiration"]) {
                self::seDeconnecter();

                Notification::ajouterPopup("Session expiré", "Vous avez été incatife trop longtemps.");
            }
            else {
                if ($cfg = self::config()) {
                    if ($cfg->get($_SESSION["administrateur"]["identifiant"])) {
                        $_SESSION["administrateur"]["expiration"] = time() + ADMIN_EXPIRATION;

                        return true;
                    }
                }
                
                self::seDeconnecter();

                Notification::ajouterPopup("Erreur dans la session", "Une erreur c'est produit.");
            }
        }

        return false;
    }

    static public function config() : ?Config {
        if (is_null(self::$fichier)) {
            self::$fichier = Config::charger(self::$chemin);
        }
        
        return self::$fichier;
    }

    static public function verifierInformation(string $identifiant, string $motDePasse) : bool {
        if ($cfg = self::config()) {
            if ($psw = $cfg->get($identifiant)) {
                if (Util::password_verify($motDePasse, $psw)) {
                    return true;
                }
            }
        }

        return false;
    }

    static public function seConnecter(string $identifiant) {
        $_SESSION["administrateur"] = [
            "identifiant" => $identifiant,
            "expiration" => time() + ADMIN_EXPIRATION
        ];
    }

    static public function seDeconnecter() {
        unset($_SESSION["administrateur"]);
    }

    static public function ajouterAdmin(string $identifiant, string $motDePasse) {
        $cfg = self::config();

        if(\is_null($cfg)) {
            $cfg = new Config([], self::$chemin);
        }

        $cfg->set($identifiant, Util::password_hash($motDePasse));
        $cfg->sauvegarder();
    }


    private function __construct() {}
}