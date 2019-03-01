<?php

namespace core;

abstract class Controleur {
    protected $vue;

    function __construct (){

    }

    /**
     * L'action du contrôleur qui permet d'afficher la vue
     *  retourne un exception en cas d'erreur
     *
     * @param array $args
     * @return \Exception|null
     */
    public abstract function action(array $args) : ?\Exception;


    public function genererVue(string $vueFile) : Vue {
        $this->vue = new \core\Vue($vueFile);

        return $this->vue;
    }
}
