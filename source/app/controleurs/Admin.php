<?php

namespace app\controleurs;

use \exceptions\Erreur404;
use \app\outils;

class Admin extends \core\Controleur {
	use atraits\Admin;

	public function action(array $args) : ?\Exception {
        if ($this->route("action:action", false)) {
            if (outils\Admin::estConnecter() || $this->route("acces", false)) {
                return self::executer($this->action, $args);
            }
            else {
                $_SESSION["page_apres_connexion"] = $args;

                self::rediriger("admin", ["acces", "connexion"]);
            }
        }

        return new Erreur404();
	}
}
