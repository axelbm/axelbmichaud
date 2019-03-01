<?php

namespace core;

abstract class Modele {
    protected $surBD = false;

    /**
     * Définie les setter et getter.
     *
     * @param string $name
     * @param array $args
     * @return void
     */
    public function __call(string $name, array $args) {
        // Si il y a un get
        if (substr($name, 0, 3) == "get") {
            $propNom = substr($name, 3);
            $prop = $this->dao()->getPropriete($propNom);
            
            if (isset($prop)) {
                // Si la propriété est une cle étrangère
                if (isset($prop["fkColonne"])) {
                    $methode = "get".$prop["key"];

                    // Trouve les objets liés a l'aide de son DAO
                    return $this->dao()->getObjetEtranger($propNom, $this->$methode());
                }
                else {
                    $propCle = $prop["key"];
    
                    return $this->$propCle;
                }
            }
        }
        // Si il y a un set
        elseif (substr($name, 0, 3) == "set") {
            $propNom = substr($name, 3);
            
            if (array_key_exists($propNom, $this->dao()->getProprietes())) {
                $prop = $this->dao()->getPropriete($propNom);

                // Impossible de set sur une cle primaire ou étrangère
                if (!$prop["isPrimaryKey"] && !isset($prop["fkColonne"])) {
                    $propCle = $prop["key"];
                    $valeur = $args[0];

                    // Vérifie si il y a une méthode onSet...
                    if (\method_exists($this, "onSet$propNom")) {
                        $methode = "onSet$propNom";

                        if (!\is_null($nv = $this->$methode($this->$propCle, $valeur)))
                            $valeur = $nv;
                    }

                    // Vérifie le type de la nouvelle valeur
                    if (gettype($args[0]) == $prop["type"] || (gettype($args[0]) == "object" and get_class($args[0]) == $prop["type"]))
                        $this->$propCle = $valeur;
                    else
                        throw(new \TypeError("Argument 1 passed to ".get_class($this)."->$name() must be an ".$prop["type"].", ".gettype($args[0])." given"));

                    return;
                }
            }
        }
        
        throw new \Exception("Call to undefined method ".\get_called_class()."->$name()");
    }

    /**
     * Retourne la liste de Primary Keys sous forme d'array.
     * [[key, value], ...]
     *
     * @return array
     */
    public function getPrimaryKeys() : array {
        $pks = [];

        foreach ($this->dao()->getPrimaryKeys() as $id => $key) {
            $methode = "get$key";

            $pks[$id] = [
                "key" => $this->dao()->getPropriete($key)["key"], 
                "value" => $this->$methode()
            ];
        }

        return $pks;
    }

    /**
     * Retourne la propriété demandé sous forme d'array.
     *  [key, value, type, options, isPrimaryKey]
     * 
     * @param string $key
     * @return array
     */
    public function getPropriete(string $key) : array {
        $prop = $this->dao()->getPropriete($key);

        $get = "get$key";
        
        if (!isset($prop["fkColonne"]))
            $prop["value"] = $this->$get();

        return $prop;
    }

    /**
     * Retourne la liste propriétés sous forme d'array.
     *  [key = [key, value, type, options, isPrimaryKey], ...]
     *
     * @return array
     */
    public function getProprietes() : array {
        $props = [];
        
        foreach ($this->dao()->getProprietes() as $key => $prop) {

            if (!isset($prop["fkColonne"]) && !(in_array("AI", $prop["options"]) && !$this->surBD)) {
                $get = "get$key";
                $prop["value"] = $this->$get();
            }

            $props[$key] = $prop;
        }

        return $props;
    }

    /**
     * Ajouter ou sauvegarde l'objet dans la base de données.
     *
     * @return void
     */
    public function sauvegarder() {
        if ($this->surBD) {
            $this->dao()->sauvegarder($this);
        } else {
            $this->dao()->ajouter($this);
        }
    }

    /**
     * Supprime l'objet de la base de données
     *
     * @return void
     */
    public function supprimer() {
        if ($this->surBD) {
            $this->dao()->supprimer($this);
        }
    }
    
    /**
     * Convertie l'objet en array.
     *
     * @return array
     */
    public function toArray() : array {
        $arr = array();

        foreach ($this->dao()->getProprietes() as $prop) {
            $propkey = $prop["key"];
            
            $value = $this->$propkey;

            if ($prop["type"] == "boolean")
                $value = $value ? 1 : 0;

            $arr[$propkey] = $value;
        }

        return $arr;
    }

    /**
     * Retourne le nom du DAO de l'objet.
     *
     * @return string
     */
    public function dao() : DAO {
        $dao = Util::objectName($this);

        return DAO::$dao();
    }

    /**
     * Undocumented function
     *
     * @param int $id
     * @return void
     */
    public function reload(int $id) {
        $pk = $this->dao()->getPrimaryKey();
        $prop = $this->dao()->getPropriete($pk);

        if (in_array('AI', $prop)) {
            $propCle = $prop["key"];
            $this->$propCle = $id;
            $this->surBD = true;
        }
    }

    /**
     * Créer un objet a l'aide d'un array.
     *
     * @param array $params
     * @return Modele
     */
    static public function toObject(array $params, ?bool $depuisDB=false) : Modele {
        $modele = get_called_class();
        $daoName = Util::className($modele);
        $dao = DAO::$daoName();

        $obj = new $modele();

        foreach ($dao->getProprietes() as $prop) {
            if (!isset($prop["fkColonne"])) {
                $propkey = $prop["key"];
                $obj->$propkey = Database::convertireVersPHP($params[$prop["key"]], $prop["type"]);
            }
        }

        if ($depuisDB)
            $obj->surBD = true;

        return $obj;
    }
}
