<?php

namespace app\controleurs\admin;

use core\Util;
use core\Config;
use exceptions\Erreur404;
use app\controleurs\atraits;
use app\outils\Admin;



class Acces extends \core\Controleur {
    
    public function action(array $args) : ?\Exception {
        if (Admin::config()) {
            if ($this->route("connexion")) {
                return $this->connexion();
            }
        }
        else {
            if ($this->route("premiereconnexion")) {
                return $this->premiereConnexion();
            }
            else {
                self::rediriger("admin", ["acces", "premiereconnexion"]);
            }
        }
        
        return new Erreur404();
    }

    public function genereCodeSecret() {
        if(!Config::exists("code_secret.p")) {
            (new Config(["code_secret" => Util::randomKey()], "code_secret.p"))->sauvegarder(); 
        }
    }

    public function premiereConnexion() : ?\Exception {
        $this->genereCodeSecret();

        $vue = $this->genererVue("admin/acces/premiereConnexion");
			
        $vue->setDisposition("simple");
        
		$vue->afficher();

		return null;
    }

    public function connexion() : ?\Exception {
        $vue = $this->genererVue("admin/acces/connexion");
			
        $vue->setDisposition("simple");
        
		$vue->afficher();

		return null;
    }
}