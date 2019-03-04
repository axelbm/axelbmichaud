<?php

namespace exceptions;

class Erreur404 extends \Exception {
    protected $message = "Page introuvable";
    protected $code = 404;

}