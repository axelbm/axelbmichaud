<?php

namespace app\dao;

use \core\DAO;

class Invitation extends DAO {
    protected $table = "invitation";

    protected $proprietes = array(
        "Courriel" => "courriel:string:PK",
        "Cle" => "cle:string"
    );
}