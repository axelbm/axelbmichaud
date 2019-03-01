<?php

namespace core;

abstract class AutoLoader {

    /**
     * Charge le fichier de la classe demandé
     *
     * @param string $name
     * @return void
     */
    static public function loader(string $name) { 
        $args = explode("\\", $name);
        $classname = array_pop($args);

        $path = ROOT;

        for ($i = 0, $count = count($args); $i < $count; ++$i) {
            $path .= $args[$i] . "/";

            if (!is_dir($path)) {
                return;
            }
        }

        $path .= "$classname.php";

        if (is_file($path)) {
            require_once $path;
        }
    }
}