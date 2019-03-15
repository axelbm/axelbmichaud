<?php

namespace core;

class Util {

    static public function className(string $class) : ?string {
        if ($pos = strrpos($class, '\\')) return substr($class, $pos + 1);
        return null;
    }

    static public function objectName(object $obj) : string {
        $class = get_class($obj);

        return self::className($class);
    }

    static public function randomKey(?int $length=16) : string {
        return bin2hex(random_bytes($length));
    }
    
    static public function password_hash(string $password) : string {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    static public function password_verify($password, $hash) : bool {
        return password_verify($password, $hash);
    }

    static public function formatDate(\Datetime $date) : string {
        return $date->format('l, j F Y H:i');
    } 
}