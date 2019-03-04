<?php

namespace app\controleurs\atraits;

use \app\modeles;
use \app\outils;

trait Admin {

    public function estConnecter() : bool {
        return false;
    }

}