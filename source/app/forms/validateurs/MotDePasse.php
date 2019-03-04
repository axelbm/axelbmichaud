<?php

namespace app\forms\validateurs;

abstract class MotDePasse implements \core\iValidateur {
    
    static public function valider($valeur) : bool {
        $valeur = trim($valeur);
        return $valeur != "" && strlen($valeur) > 6;
    }

}