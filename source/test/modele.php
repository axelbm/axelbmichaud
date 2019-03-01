<?php

use app\dao;
use app\modeles;

$part = modeles\Participation::toObject([
    "reunionid" => 123,
    "courriel" => "axel@gmail.com",
    "statutid" => "idk"
]);

var_dump($part->getProprietes());



var_dump($part->getPrimaryKeys());

