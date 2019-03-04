<?php

namespace core;

abstract class Controleur extends MainControleur {
    protected $vue;
    protected $args;

    function __construct(array $args){
        $this->args = $args;
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

    public function shift(int $time=1) {
        if ($time == 1) {
            return \array_shift($this->args);
        }
        else {
            $args = [];
            for ($i=0; $i < $time; $i++) { 
                \array_push($args, \array_shift($this->args));
            }

            return $args;
        }
    }

    public function argument(int $index) {
        if (isset($this->args[$index])) {
            return $this->args[$index];
        }

        return null;
    }

    public function route(string $route, ?bool $strict=true) : bool {
        $params = \explode("/", $route);

        if (end($params) == '') {
            array_pop($params);
        }
        
        if ($strict && count($this->args) != count($params)) {
            return false;
        }

        foreach ($params as $i => $param) {
            $value = $this->argument($i);
            $opt = explode(":", $param);

            if (count($opt) == 1) {
                if ($value != $opt[0]) {
                    return false;
                }
            }
            elseif (count($opt) == 2) {
                $type = $opt[0];
                $key = $opt[1];

                switch ($type) {
                    case '':
                        if (is_null($value)) {
                            return false;
                        } else {
                            $this->$key = $value;
                        }
                        break;
                    case 'int':
                        if (!is_numeric($value)) {
                            return false;
                        } else {
                            $this->$key = intval($value);
                        }
                        break;
                    case 'action':
                        $action = Util::objectName($this)."\\".$value;

                        if (!self::exists($action)) {
                            return false;
                        } else {
                            $this->$key = $action;
                        }
                        break;
                    
                    default:
                        if ($dao = DAO::get($type)) {
                            if ($obj = $dao->find($value)) {
                                $this->$key = $obj;
                            }
                            else {
                                return false;
                            }
                        }
                        else {
                            return false;
                        }
                }
            }
        }

        return true;
    }
}
