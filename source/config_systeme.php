<?php

define('ROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));
define('WEBROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));

define('PUBLICROOT', WEBROOT.'public/');

define('APPROOT', ROOT.'app/');
define('COREROOT', ROOT.'core/');
define('VUEROOT', ROOT.'app/vues/');
define('DATAROOT', ROOT.'data/');