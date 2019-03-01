<?php

namespace app\controleurs;

class Erreur extends \core\Controleur {

    public function action(array $args) : ?\Exception {
        $err = $args[0];

        $vue = new \core\Vue("erreur");

        $vue->setDisposition("erreur");

        $vue->set("erreur", $err);
        $vue->set("code", $err->getCode());
        $vue->set("message", $err->getMessage());

        if ($err->getCode() == 404) {
            $vue->set("description", "La page que vous cherchez n'existe pas ou l'URL est incorrecte");
        } 

        $vue->afficher();

        return null;
    }

}
