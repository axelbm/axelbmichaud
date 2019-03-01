<?php

namespace app\controleurs\atraits;

use \app\modeles;
use \app\outils;

trait Utilisateur {
    protected $utilisateur;

    /**
     * Fait les verification pour obtenir l'utilisateur et l'injecter dans la vue
     *
     * @return void
     */
    public function verifierUtilisateur() {
        $this->utilisateur = outils\Session::getUtilisateur();
        if ($this->vue)
            $this->vue->set("utilisateur", $this->utilisateur);
    }

    public function getUtilisateur() : ?modeles\Utilisateur {
        return $this->utilisateur;
    }

    public function estConnecter() : bool {
        return !is_null($this->utilisateur);
    }
}