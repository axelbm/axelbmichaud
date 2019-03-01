<?php

namespace core;

class Session {
    
    static public function getFormAction(string $formId) : ?array {
        if (isset($_SESSION["formsId"][$formId]))
            return $_SESSION["formsId"][$formId];
        else
            return null;
    }

    static public function ajouterFormAction(string $formId, string $formAction) : int {
        $pos = count($_SESSION["formsId"]);

        $_SESSION["formsId"][$formId] = [$formAction, $pos];

        return $pos;
    }

    static public function viderFormAction() {
        $_SESSION["formsId"] = [];
    }

    static public function initializer() {
        if (!self::estOuverte()) {
            $_SESSION["token"] = Util::randomKey();
            $_SESSION["formsId"] = [];
        }
    } 

    static public function estOuverte() : bool {
        return isset($_SESSION) and isset($_SESSION["token"]);
    }

    static public function detruire(){
        // session_destroy();
    }
}