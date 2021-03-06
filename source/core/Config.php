<?php

namespace core;

class Config {
    
    
    static public function sauvegarderFichier(Config $config) {
        $data = self::arr2ini($config->getData());
        
        $f = fopen(DATAROOT.$config->getChemin().'.ini', "w");
        fwrite($f, $data);
        fclose($f);
    }
    
    static public function charger(string $chemin) : ?Config {
        if (self::exists($chemin)) {
            $data = \parse_ini_file(DATAROOT.$chemin.'.ini');
            
            return new self($data, $chemin);
        }
        
        return null;
    }

    static public function exists(string $chemin) : bool {
        return file_exists(DATAROOT.$chemin.'.ini');
    }

    static public function supprimerFichier(string $chemin) {
        if (self::exists($chemin)) {
            unlink(DATAROOT.$chemin.'.ini');
        }
    }
    
    /**
     * https://stackoverflow.com/questions/17316873/convert-array-to-an-ini-file
    */
    static public function arr2ini(array $arr) : string {
        $out = '';
        
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                //subsection case
                //merge all the sections into one array...
                $sec = array_merge((array) $parent, (array) $key);
                //add section information to the output
                $out .= '[' . join('.', $sec) . ']' . PHP_EOL;
                //recursively traverse deeper
                $out .= arr2ini($value, $sec);
            }
            else {
                //plain key->value case
                $out .= "$key=$value" . PHP_EOL;
            }
        }
        
        return $out;
    }
    
    
    /** @var array */
    private $data;
    /** @var string */
    private $chemin;
    
    
    public function __construct(?array $data=[], ?string $chemin=null) {
        $this->data = $data;
        $this->chemin = $chemin;
    }
    
    public function setChemin(string $chemin) {
        $this->chemin = $chemin;
    }
    
    public function getChemin() : string {
        return $this->chemin;
    }
    
    public function setData(array $data) {
        $this->data = $data;
    }
    
    public function getData() : array {
        return $this->data;
    }

    public function get(string $nom) {
        if(isset($this->data[$nom]))
            return $this->data[$nom];

        return null;
    }
    
    public function set(string $nom, $valeur) {
        $this->data[$nom] = $valeur;
    }

    public function __get(string $nom) {
        if (isset($this->data[$nom]))
            return $this->get($nom);
    }
    
    public function __set(string $nom, $valeur) {
        $this->set($nom, $valeur);
    }
    
    public function sauvegarder(?string $chemin=null) {
        if (!is_null($chemin)) {
            $this->chemin = $chemin;
        }
        
        if (is_null($this->chemin)) {
            throw new \Exception("Sauvegarde impossible, pas de chemin defini.");
        }
        else {
            self::sauvegarderFichier($this);
        }
    }

    public function supprimer() {
        if (is_null($this->chemin)) {
            throw new \Exception("Sauvegarde impossible, pas de chemin defini.");
        }
        else {
            self::supprimerFichier($this->getChemin());
        }
    }
}