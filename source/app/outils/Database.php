<?php

namespace app\outils;

use core\Config;

final class Database {
    static private $chemin = "database.p";

    static public function sauvegarder(string $hote, int $port, string $nom, string $identifiant, string $motDePasse) {
        $cfg = self::charger();

        if(is_null($cfg)) {
            $cfg = new Config([], self::$chemin);
        }

        $cfg->hote = $hote;
        $cfg->port = $port;
        $cfg->nom = $nom;
        $cfg->identifiant = $identifiant;
        $cfg->motDePasse = $motDePasse;

        $cfg->sauvegarder();
    }

    static public function charger() : ?Config {
        return Config::charger(self::$chemin);
    }

    static public function verifier(string $hote, ?int $port=3306, string $nom, string $identifiant, string $motDePasse) : ?\Exception {
        try {
            \core\Database::connect($hote, $nom, $identifiant, $motDePasse);
            return null;
        } catch (\Exception $th) {
            return $th;
        }
    }
}