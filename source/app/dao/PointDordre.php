<?php

namespace app\dao;

use \core\DAO;
use \core\Database;

class PointDordre extends DAO {
    static private $nppDefaut = 10;

    protected $table = "pointdordres";

    protected $proprietes = array(
        "Id" => "pointdordreid:integer:PK,AI",
        "ReunionID" => "reunionid:integer",
        "Titre" => "titre:string",
        "Description" => "description:string",
        "DossierID" => "dossierid:integer",
        "CompteRendu" => "compterendu:string",

        "Reunion" => "ReunionID:Reunion:FK,S:reunionid",
        "Dossier" => "DossierID:Dossier:FK,S:dossierid"
    );

    public function getListeParTitre(int $page, ?string $titre = "", ?int $npp = 10) : array{
        return $this->select("WHERE CONTAINS(titre , ?) LIMIT ?, ? ORDER BY titre", $titre, $page*$npp, $npp);
    }

    public function getPage(?string $titre = "", ?int $npp = 10) : int{
        if (is_null($npp))
        $npp = self::$nppDefaut;

        $statement = Database::query("select count(pointdordreid) from pointdordres WHERE CONTAINS(titre , ?)", $titre);
        $result = $statement->fetch();
        $nombre = $result[0];
        return ceil($nombre / $npp);
    }
}