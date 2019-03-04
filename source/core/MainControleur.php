<?php

// va etre le premier controleur qui etre appelé par le rooter
// Il va appeler le controleur correspondant a la requete

namespace core;

abstract class MainControleur {

	static private $instance = null;


	/**
	 * Execute le controleur lié a l'action demandé
	 * 	Si un controleur retourne un erreur, la page va etre redirigé vers une page d'erreur
	 *
	 * @param string $action
	 * @param array $params
	 */
	static function executer(string $action, array $params) : void {
		$controleurClass = "\\app\\controleurs\\" . ucfirst($action);

		if (self::exists($action)) {
			$ctrl = new $controleurClass($params);

			self::$instance = $ctrl;

			$err = $ctrl->action($params);

			if (!is_null($err)) {
				self::executerErreur($err);
			}

		} else {
			self::executerErreur(new \Exception("Page introuvable", 404));
		}

		exit;
	}

	/**
	 * Verifie si le controleur demandé existe
	 *
	 * @param string $action
	 * @return boolean
	 */
	static function exists(string $action) : bool {
		return \class_exists("\\app\\controleurs\\" . ucfirst($action));
	}

	static function executerErreur(\Exception $err) {
		if (self::exists("Erreur_".$err->getCode())) {
			self::executer("Erreur_".$err->getCode(), array($err));
		} else {
			self::executer("Erreur", array($err));
		}
	}

	/**
	 * Retourne le controleur utilisé
	 *
	 * @return Controleur
	 */
	static function getInstance() : Controleur {
		return self::$instance;
	}


	static function rediriger(?string $action="", ?array $params=[]) {
		header('Location: '. WEBROOT .$action . ($params ? "/".implode("/", $params) : ""));
		exit;
	}
}
