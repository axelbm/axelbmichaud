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
        $args = explode("\\", strtolower($name));
        $classname = array_pop($args);

        $dir = ROOT;

        for ($i = 0, $count = count($args); $i < $count; ++$i) {
            $dir .= $args[$i] . "/";

            if (!is_dir($dir)) {
                return;
            }
        }

        $path = $dir."$classname.php";

        if (is_file($path)) {
            require_once $path;
        } else {
            foreach (scandir($dir) as $i => $name) {
                if ("$classname.php" == strtolower($name)) {
                    require_once $dir.$name;
                }
            }
        }
    }
}