<?php

namespace app\forms\validateurs;

abstract class Courriel implements \core\iValidateur {
    
    static public function valider($valeur) : bool {
        try {
            new \DateTime($valeur);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}