<?php

namespace core;

class MainForm {
	static private $instance = null;


	/**
	 * Execute le controleur lié a l'action demandé
	 * 	Si un controleur retourne un erreur, la page va etre redirigé vers une page d'erreur
	 *
	 * @param string $action
	 * @param array $params
	 */
	static function executer(string $action, int $pos) : void {
		$formClass = "\\app\\forms\\" . ucfirst($action);

		if (self::exists($action)) {
			$form = new $formClass($action, $pos);

			self::$instance = $form;

			$form->valider();

			if ($form->succes())
				$form->action();
		}
	}

	static function trouverForm() {
		if (isset($_POST["formid"])) {
			$formId = $_POST["formid"];
			

			if ($info = Session::getFormAction($formId)) {
				self::executer($info[0], $info[1]);
			}
		}

		Session::viderFormAction();

		if (isset($_POST["ajax"])) {
			$form = self::$instance;

			if ($form) {
				$data = [
					"valid" => $form->succes(),
					"erreurs" => $form->getErreurs(),
					"formid" => $_POST["formid"],
					"newFormid" => self::nouveauFormId($form->getAction())[0]
				];

				$data = array_merge($data, $form->getAjax());
			} else{
				$data = ["valid" => false];
			}
			echo json_encode($data);

			exit;
		}
	}

	/**
	 * Verifie si le controleur demandé existe
	 *
	 * @param string $action
	 * @return boolean
	 */
	static function exists(string $action) : bool {
		return \class_exists("\\app\\forms\\" . ucfirst($action));
    }
    
    /**
     * Undocumented function
     *
     * @param string $action
     * @return string
     */
    static function nouveauFormId(string $action) : array {
        $id = Util::randomKey();

        $pos = Session::ajouterFormAction($id, $action);

        return [$id, $pos];
    }

	/**
	 * Retourne le controleur utilisé
	 *
	 * @return Form
	 */
	static function getInstance() : ?Form {
		return self::$instance;
	}
}