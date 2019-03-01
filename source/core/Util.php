<?php

namespace core;

class Util {

    public static function className(string $class) : ?string {
        if ($pos = strrpos($class, '\\')) return substr($class, $pos + 1);
        return null;
    }

    public static function objectName(object $obj) : string {
        $class = get_class($obj);

        return self::className($class);
    }

    public static function randomKey(?int $length=16) : string {
        return bin2hex(random_bytes($length));
    }
}