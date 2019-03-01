<?php

namespace app\outils;

use \app\modeles;
use \app\outils;

class Notification {
    static public function ajouterPopup(string $titre, ?string $contenu=null, ?array $options=[]) {
        if (is_null($contenu)) {
            $_SESSION["popup"] = [
                "titre" => "",
                "contenu" => $titre,
                "options" => $options
            ];
        }
        else {
            $_SESSION["popup"] = [
                "titre" => $titre,
                "contenu" => $contenu,
                "options" => $options
            ];
        }
    }

    static public function getPopupInfo() : ?Notification {
        if (isset($_SESSION["popup"])) {
            $i = $_SESSION["popup"];
            unset($_SESSION["popup"]);

            return new Notification($i['titre'], $i['contenu'], $i['options']);
        }

        return null;
    }

    /** @var string */
    private $titre;

    /** @var string */
    private $contenu;

    /** @var array */
    private $options;

    public function __construct(string $titre, string $contenu, array $options=[]) {
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->options = $options;
    }

    public function getTitre() : ?string {
        return $this->titre;
    }

    public function getContenu() : string {
        return $this->contenu;
    }

    public function options($cle) {
        if (isset($this->options[$cle])) {
            return $this->options[$cle];
        }

        return null;
    }
}