<?php

namespace core;

class Vue {

    private $titre = SITE_NOM;
    private $vueFile;
    private $jsVars = [];
    private $vars = [];
    private $jsFiles = [];
    private $cssFiles = [];
    private $contenue;
    private $disposition = "index";

    /**
     * Constructeur de Vue avec le fichier de sa vue.
     *
     * @param string $vueFile
     */
    public function __construct(string $vueFile) {
        $this->vueFile = $vueFile;
    }
    
    /**
     * Affiche le html de la vue.
     *
     * @return void
     */
    public function afficher() {
        
        
        $this->addScript("$this->disposition.js");
        $this->addStyle("$this->disposition.css");

        $this->addScript("scripts/$this->vueFile.js");
        $this->addStyle("styles/$this->vueFile.css");

        // Extrait les variables stockés dans le vue
        extract($this->vars);

        // Définie des variables importantes pour la vue
        $vue = $this;
        $controleur = MainControleur::getInstance();
        $titre = $this->titre;

        // Emmagasine le code html du fichier de la vue pour l'injecter dans l'index
        ob_start();
		require VUEROOT.$this->vueFile.'.php';
        $contenue = ob_get_clean();

        require VUEROOT."dispositions/".$this->disposition.".php";
    }

    /**
     * Injecte une valeur dans le context de la vue
     *
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value) {
        $this->vars[$key] = $value;
    }


    /**
     * Inject une valeur dans le context du Javascript
     *
     * @param string $key
     * @param mixed $value
     */
    public function setJSVar(string $key, $value) {
        $this->jsVars[$key] = $value;
    }

    /**
     * Retourne la liste des variables du context Javascript
     *
     * @return array
     */
    public function getJSVars() : array {
        return $this->jsVars;
    }

    /**
     * Modifie le titre de la page
     *
     * @return void
     */
    public function setTitre(string $titre) : void {
        $this->titre = $titre;
    }

    public function addScript(string $fichier) : void {
        $fichier = "public/$fichier";
        
        if (file_exists(APPROOT.$fichier)) {
            \array_push($this->jsFiles, WEBROOT.$fichier);
        }
    }

    public function addStyle(string $fichier) : void {
        $fichier = "public/$fichier";

        if (file_exists(APPROOT.$fichier)) {
            \array_push($this->cssFiles, WEBROOT.$fichier);
        }
    }

    
    public function getScripts() : array {
        return $this->jsFiles;
    }
    
    public function getStyles() : array {
        return $this->cssFiles;
    }

    public function setDisposition(string $fichier) {
        $this->disposition = $fichier;
    }

    /**
     * Undocumented function
     *
     * @param string $action
     * @return FormView
     */
    public function newForm(string $action) : FormView {
        return new FormView($action);
    }
}