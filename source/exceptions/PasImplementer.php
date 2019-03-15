<?php

namespace exceptions;

class PasImplementer extends \Exception {
    protected $message = "La page n'est pas encore implementé.";
    protected $code = 500;

}