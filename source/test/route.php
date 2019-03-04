<?php

$route = "";

$params = explode("/", $route);
if (end($params) == '') {
    array_pop($params);
}

var_dump($params);

foreach ($params as $key => $value) {
    $opt = explode(":", $value);

    var_dump($opt);
}