<?php

$chemin = "tessst.p";

if($config = \core\Config::Charger($chemin)) {
    
    var_dump($config);
    
    $config->modification = (new DateTime())->format('Y-m-d H:i:s');
    
    $config->sauvegarder();
}
else {
    $config = new \core\Config();
    
    $config->creation = (new DateTime())->format('Y-m-d H:i:s');
    
    $config->sauvegarder($chemin);
}