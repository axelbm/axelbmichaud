<?php

namespace app\dao;

use \core\DAO;
use \core\Database;
use \app\modeles;

class Dossier extends DAO {
    static private $nppDefaut = 10;

    protected $table = "dossiers";

    protected $proprietes = array(
        "Id" => "dossierid:integer:PK,AI",
        "Nom" => "nom:string",
        "Description" => "description:string",

        "PointDordres" => "Id:PointDordre:FK:dossierid"
    );

    public function getListeParReunion(int $page, modeles\Reunion $reunion, ?int $npp = null) : array{
        if (is_null($npp))
            $npp = self::$nppDefaut;

        return $this->select("INNER JOIN pointdordres ON dossiers.dossierid = pointdordres.dossierid
            WHERE pointdordres.reunionid = ? ORDER BY nom LIMIT ?, ?", $reunion->getId(), $page*$npp, $npp);
    }

    public function getListe(int $page, ?int $npp = null) : array{
        if (is_null($npp))
            $npp = self::$nppDefaut;
            
        return $this->select("ORDER BY nom LIMIT ?, ?", $page*$npp, $npp);
    }

    public function getListeParNom(int $page, string $nom, ?int $npp = null) : array{
        if (is_null($npp))
            $npp = self::$nppDefaut;
            
        return $this->select("WHERE nom = ? ORDER BY nom LIMIT ?, ?", $nom, $page*$npp, $npp);
    }

    public function getPage(?int $npp = null) : int{
        if (is_null($npp))
            $npp = self::$nppDefaut;
            
        $statement = Database::query("select count(dossierid) from dossiers");
        $result = $statement->fetch();
        $nombre = $result[0];
        return ceil($nombre / $npp);
    }

    public function getPageParNom(?string $nom = "", ?int $npp = null) : int{
        if (is_null($npp))
            $npp = self::$nppDefaut;
            
        $statement = Database::query("select count(dossierid) from dossiers WHERE CONTAINS(nom , ?)", $nom);
        $result = $statement->fetch();
        $nombre = $result[0];
        return ceil($nombre / $npp);
    }

    public function getPageParReunion(modeles\Reunion $reunion, ?int $npp = null) : int{
        if (is_null($npp))
            $npp = self::$nppDefaut;
            
        $statement = Database::query("select count(dossierid) from dossiers 
            INNER JOIN pointdordres ON dossiers.dossierid = pointdordres.dossierid
            WHERE pointdordres.reunionid = ?", $reunion->getId());
        $result = $statement->fetch();
        $nombre = $result[0];
        return ceil($nombre / $npp);
    }
}