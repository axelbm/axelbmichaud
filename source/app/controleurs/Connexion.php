<?php

namespace app\controleurs;

use core\Controleur;
use exceptions\Erreur404;

class Connexion extends Controleur {
    use atraits\Utilisateur;


    public function action(array $args) : ?\Exception {

        if ($this->route("")) {
            if ($this->estConnecter()) {
                self::rediriger();
            }

            $vue = $this->genererVue("connexion");

            $vue->afficher();

            return null;
        }

        return new Erreur404();
    }

}