<?php

namespace core;

abstract class Form {
    protected $action;
    protected $erreurs = [];
    protected $position = 0;
    protected $ajaxVals = [];

    public function __construct(string $action, int $pos) {
        $this->action = $action;
        $this->position = $pos;

        foreach ($_POST as $key => $value)
            if (\property_exists($this, $key))
                $this->$key = $value;
        // $this->parseProprietes();

        // foreach ($this->getProprietes() as $key => $prop) {
        //     if (!$this->validerChamp($key, $_POST[$key])) {

        //         $this->ajouterErreur($key, "Le champ $key est invalide.");
        //     }
            
        //     $this->$key = $_POST[$key];
        // }
    }

    public function parseProprietes() {
        $proprietes = [];

        foreach ($this->proprietes as $key => $value) {
            // Divide la propriété a chaque :
            $args = explode(":", $value);
            $options = [];

            // Déclenche une exception si il y a pas le bon nombre de paramètres
            if (count($args) < 1 || count($args) > 2)
                throw(new \Exception());

            // Divise le 3em paramètre en options
            if (count($args) > 1)
                $options = explode(",", $args[1]);

            // Construit la propriété a l'aide des paramètres
            $prop = array(
                "type" => $args[0],
                "options" => $options
            );

            $proprietes[$key] = $prop;
        }

        $this->proprietes = $proprietes;
    }

    /**
     * Retourne la propriété demandé
     * [type, options[...]]
     *
     * @param string $nom
     * @return array
     */
    public function getPropriete(string $nom) : array {
        return $this->proprietes[$nom];
    }

    /**
     * Retourne la liste des propriétés
     *  [[type, options[...], ...]
     * 
     * @return array
     */
    public function getProprietes() : array {
        return $this->proprietes;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public abstract function valider();

    /**
     * Undocumented function
     *
     * @return void
     */
    public abstract function action();

    /**
     * Undocumented function
     *
     * @param string $cle
     * @param mixed $valeur
     * @return boolean
     */
    public function validerChamp(string $type, $valeur) : bool {
        $validateur = "\\app\\forms\\validateurs\\".$type;

        
        if (\class_exists($validateur)) {
            return $validateur::valider($valeur);
        }
        elseif ($valeur instanceof $type) {
            return true;
        }

        return false;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function succes() : bool {
        return count($this->erreurs) == 0;
    }

    /**
     * Undocumented function
     *
     * @param string $erreur
     * @return void
     */
    public function ajouterErreur(string $cle, string $erreur) {
        $this->erreurs[$cle] = $erreur;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getErreurs() : array {
        return $this->erreurs;
    }

    /**
     * Undocumented function
     *
     * @param integer|null $index
     * @return string
     */
    public function getErreur(string $index) : ?string {
        if (isset($this->erreurs[$index]))
            return $this->erreurs[$index];
        
        return null;
    }


    public function getPosition() : int {
        return $this->position;
    }

    public function getAction() : string {
        return $this->action;
    }

    public function setAjax(string $key, $value) {
        $this->ajaxVals[$key] = $value;
    }

    public function getAjax() : array {
        return $this->ajaxVals;
    }
}