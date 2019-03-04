<?php

namespace app\controleurs;

use \exceptions\Erreur404;

class Admin extends \core\Controleur {
	use atraits\Admin;

	public function action(array $args) : ?\Exception {
        if ($this->route("action:action", false)) {
            if ($this->estConnecter() || $this->route("acces/connexion")) {
                return self::executer($this->action, $args);
            }
            else {
                self::rediriger("admin", ["acces", "connexion"]);
            }
        }

        return new Erreur404();
	}
}
