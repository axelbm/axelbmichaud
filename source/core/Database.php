<?php

namespace core;

abstract class Database {

	static private $instance;

	/**
	 * Crée une connexion a un base de donnée.
	 *
	 * @param string $hostname
	 * @param string $dbname
	 * @param string $username
	 * @param string $password
	 * @param array|null $option
	 * @return void
	 */
	static public function connect(string $hostname, string $dbname=null, string $username=null, string $password=null, ?array $option=[]){
		$dsn = 'mysql:host='.$hostname.';dbname='.$dbname;
		
		$db = new \PDO($dsn, $username, $password, $option);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
		$db->exec("set names utf8");
		
		self::$instance = $db;
	}

	static public function estConnecter() : bool {
		return !\is_null(self::$instance);
	}
	
	/**
	 * Retourne l'instance PDO connecté de la base de donnée.
	 *
	 * @return \PDO
	 */
	static public function getInstance() : \PDO {
		if (\is_null(self::$instance))
			throw(new \Exception("La base de données n'est pas initialisé"));
		else
			return self::$instance;
	}
	
	/**
	 * Exécute une requête SQL et retourne un PDOStatement 
	 *
	 * @param string $statement
	 * @return \PDOStatement
	 */
	static public function query(string $statement, ...$args) : \PDOStatement {
		if (\is_null(self::$instance)) {
			throw(new \Exception("La base de données n'est pas initialisé"));
		}
		else {
			$stmt = self::prepare($statement, ...$args);
			$stmt->execute();

			return $stmt;
		}
	}
	
	/**
	 * Prépare une requête à l'exécution et retourne un PDOStatement
	 *
	 * @param string $statement
	 * @param mixed ...$args
	 * @return \PDOStatement
	 */
	static public function prepare(string $statement, ...$args) : \PDOStatement {
		if (\is_null(self::$instance)) { 
			throw(new \Exception("La base de données n'est pas initialisé"));
		}
		else {
			$stmt = self::$instance->prepare($statement);

			if (isset($args) && count($args) > 0) {
				if (is_array($args[0])) {
					foreach ($args[0] as $key => $value) {
						$key = is_int($key) ? $key + 1 : $key;
						$type = is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
						$stmt->bindValue($key, $value, $type);
					}
				}
				else {
					foreach ($args as $i => $value) {
						$type = is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
						$stmt->bindValue($i + 1, $value, $type);
					}
				}
			}
			
			return $stmt;
		}
	}

	/**
	 * Convertie une value d'une base de données pour PHP
	 *
	 * @param mixed $var
	 * @param string $type
	 * @return mixed
	 */
	static public function convertireVersPHP($var, string $type) {
		switch ($type) {
			case 'boolean':
				return $var == 1;
			case 'DateTime':
				return new \DateTime($var);
			case 'int':
				return intval($var);
			case 'array':
				return explode(",", $var);
			
			default:
				return $var;
		}
	}

	/**
	 * Convertie une value de PHP pour une basse de données
	 *
	 * @param mixed $var
	 * @param string $type
	 * @return mixed
	 */
	static public function convertireVersDB($var, string $type) {
		switch ($type) {
			case 'boolean':
				return $var ? 1 : 0;
			case 'DateTime':
				return $var->format('Y-m-d H:i:s');
			case 'array':
				return implode(",", $var);
			
			default:
				return $var;
		}
	}
}