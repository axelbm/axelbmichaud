<?php

namespace core;

abstract class DAO {
    static private $instances = [];

    protected $proprietes = [];
    protected $primaryKeys = [];
    protected $parsedProprietes = null;

    static public function __callStatic($key, $args) : DAO {
        $daoClass = "\\app\\dao\\$key";

        if (\class_exists($daoClass)) {
            if (!isset(self::$instances[$daoClass]))
                self::$instances[$daoClass] = new $daoClass();

            return self::$instances[$daoClass];
        }

        return null;
    }

    private function __construct() {
        $this->parseProprietes();
    }

    /**
     * Convertie les propriétés du DAO
     *
     * @return void
     */
    private function parseProprietes() {
        $proprietes = [];

        /**
         * Exemples de propriétés :
         *  <Nom> => "<colonne>:<type>:<options, ...>:?<colonne étrangère>"
         * 
         *  "Courriel" => "courriel:string:PK",
         *  "Nom" => "nom:string",
         *  "Participations" => "Courriel:Participation:FK:courriel"
         * 
         *  Pour la clé étrangère, il faut indiquer la clé interne, l'objet étranger et pour finir, la colonne de l'objet étranger
         *      Il est possible d'ajouter l'option "S" pour obtenir un seul objet au lieu d'un array
         */

        foreach ($this->proprietes as $key => $value) {
            // Divide la propriété a chaque :
            $args = explode(":", $value);
            $options = [];

            // Déclenche une exception si il y a pas le bon nombre de paramètres
            if (count($args) < 2 || count($args) > 4)
                throw(new \Exception());

            // Divise le 3em paramètre en options
            if (count($args) > 2)
                $options = explode(",", $args[2]);

            // Détecte si il y a l'option PK pour la clé primaire
            $is_primatry = \in_array("PK", $options);

            // Construit la propriété a l'aide des paramètres
            $prop = array(
                "key" => $args[0],
                "type" => $args[1],
                "options" => $options,
                "isPrimaryKey" => $is_primatry
            );

            // Détecte si il y a une clé étrangère
            if (\in_array("FK", $options)) {
                $prop["fkColonne"] = $args[3];
            }

            $proprietes[$key] = $prop;
            
            // Si il y a le PK, ajoute la propriété au clés primaire
            if ($is_primatry)
                \array_push($this->primaryKeys, $key);
        }

        $this->proprietes = $proprietes;
    }

    /**
     * Retourne la propriété demandé
     * [key, type, options[\.\.\.], isPrimaryKey]
     *
     * @param string $nom
     * @return array
     */
    public function getPropriete(string $nom) : array {
        return $this->proprietes[$nom];
    }

    /**
     * Retourne la liste des propriétés
     *  [[key, type, options[\.\.\.], isPrimaryKey], \.\.\.]
     * 
     * @return array
     */
    public function getProprietes() : array {
        return $this->proprietes;
    }

    /**
     * Retourne la liste des primary keys
     *
     * @return array
     */
    public function getPrimaryKeys() : array {
        return $this->primaryKeys;
    }

    /**
     * Retourne la N iem primary key du DAO
     *
     * @param integer $id
     * @return string
     */
    public function getPrimaryKey(int $id=0) : string {
        return $this->primaryKeys[$id];
    }

    /**
     * Ajoute l'objet dans la base de données
     *
     * @param Modele $obj
     * @return void
     */
    public function ajouter(Modele $obj) {
        $colonne = [];
        $colonneKey = [];
        $valeurs = [];
        $estAutoInc = false;

        // fait la liste des clés primaires, colonnes et de leurs valeurs 
        foreach ($obj->getProprietes() as $prop) {
            if (isset($prop["fkColonne"])) {
                continue;
            }
            if (in_array("AI", $prop["options"])) {
                $estAutoInc = true;
                continue;
            }
             
            \array_push($colonne, $prop["key"]);
            \array_push($colonneKey, ":".$prop["key"]);
            $valeurs[":" . $prop["key"]] = Database::convertireVersDB($prop["value"], $prop["type"]);
        }

        $colonne = \implode(", ", $colonne);
        $colonneKey = \implode(", ", $colonneKey);
        
        $stendment = "INSERT INTO $this->table ($colonne) VALUES ($colonneKey)";

        $stmt = Database::prepare($stendment);
        $stmt->execute($valeurs);

        if (!is_null($estAutoInc)) {
            $id = Database::query("SELECT LAST_INSERT_ID();")->fetch()[0];
            $obj->reload($id);
        }
    }

    /**
     * Sauvegarde l'objet dans la base de données
     *
     * @param Modele $obj
     * @return void
     */
    public function sauvegarder(Modele $obj) {
        $condition = [];
        $colonne = [];
        $valeurs = [];

        foreach ($obj->getProprietes() as $prop) {
            if (isset($prop["fkColonne"]))
                continue;

            $valeurs[":" . $prop["key"]] = Database::convertireVersDB($prop["value"], $prop["type"]);

            if ($prop["isPrimaryKey"])
                \array_push($condition, $prop["key"] . " = :" . $prop["key"]);
            else
                \array_push($colonne, $prop["key"] . " = :" . $prop["key"]);
        }

        $condition = \implode(" AND ", $condition);
        $colonne = \implode(", ", $colonne);
        
        $stendment = "UPDATE $this->table SET $colonne WHERE $condition";

        $stmt = Database::prepare($stendment);
        $stmt->execute($valeurs);
    }
    
    /**
     * Supprime un objet de la base de données a partir de ses clés ou de son objet
     *
     * @param [type] ...$index
     * @return void
     */
    public function supprimer(...$index) {
        $conditions = [];
        $valeurs = [];

        foreach ($index as $id => $valeur) {
            if ($id == 0 && $valeur instanceof Modele){
                foreach ($valeur->getProprietes() as $key => $prop) {
                    if ($prop["isPrimaryKey"]) {
                        $valeurs[":" . $prop["key"]] = Database::convertireVersDB($prop["value"], $prop["type"]);
                        \array_push($conditions, $prop["key"] . " = :" . $prop["key"]);
                    }
                }

                break;
            }

            $key = $this->getPropriete($this->getPrimaryKey($id))["key"];

            $valeurs[":$key"] = $valeur;
            \array_push($conditions, "$key = :$key");
        }

        $conditions = \implode(" AND ", $conditions);
        
        $stendment = "DELETE FROM $this->table WHERE $conditions";

        $stmt = Database::prepare($stendment);
        $stmt->execute($valeurs);
    }

    /**
     * Trouve un objet a partir de ses primary keys
     *
     * @param mixed ...$keys
     * @return Modele|null
     */
    public function find(...$index) : ?Modele {
        $conditions = [];
        $valeurs = [];

        foreach ($index as $id => $valeur) {
            $key = $this->getPropriete($this->getPrimaryKey($id))["key"];

            $valeurs[":$key"] = $valeur;
            \array_push($conditions, "$key = :$key");
        }

        $conditions = \implode(" AND ", $conditions);
        
        $stendment = "SELECT * FROM $this->table WHERE $conditions";

        $stmt = Database::prepare($stendment);
        $stmt->execute($valeurs);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $this->charger($result);
        }

        return null;
    }

    /**
     * Fait une liste d'objets a partir d'une requête sql.
     *
     * @param string|null $requête
     * @param array|null $input
     * @return array
     */
    public function select(?string $requete="", ...$input) : array {
        $requete = "SELECT * FROM $this->table $requete";

        // var_dump($requete);
        $stmt = Database::prepare($requete, ...$input);

        $stmt->execute();
        
        $objs = [];

        $modele = "\\app\\modeles\\".Util::className(get_called_class());

        while ($result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($objs, $modele::toObject($result, true));
        }

        return $objs;
    }

    public function selectFirst(?string $requete="", ...$input) : ?Modele {
        $result = $this->select($requete, ...$input);

        if (isset($result[0]))
            return $result[0];
            
        return null;
    }

    /**
     * Récupère les objets étrangères d'un objet
     *
     * @param string $colonne
     * @param mixed $valeur
     * @param string|null $condition
     * @return mixed
     */
    public function getObjetEtranger(string $colonne, $valeur, ?string $condition="") {
        $prop = $this->getPropriete($colonne);

        $fkDAO = $prop["type"];
        
        $result = self::$fkDAO()->select("WHERE ".$prop["fkColonne"]." = ?", $valeur);

        if (in_array("S", $prop["options"])) {
            if (isset($result[0])) {
                return $result[0];
            }
        }
        else {
            return $result;
        }

        return null;
    }

    /**
     * Créer un objet a partir de ses paramètres
     *
     * @param array $params
     * @return Modele
     */
    public function charger(array $params) : Modele {
        $modele = "\\app\\modeles\\".Util::className(get_called_class());

        return $modele::toObject($params, true);
    }



    public function getTable() : string {
        return $this->table;
    } 
}