<?php

namespace app\forms\validateurs;

abstract class Courriel implements \core\iValidateur {
    
    static public function valider($valeur) : bool {
        return filter_var($valeur, FILTER_VALIDATE_EMAIL);
    }

}