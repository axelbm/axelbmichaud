<?php

use \app\modeles;
use \app\dao;

$par = \app\dao\Participation::find(1, "axel@gmail.com");

var_dump($par);

var_dump($par->getUtilisateur());

var_dump($par->getUtilisateur()->getParticipations());

var_dump($par->getUtilisateur()->getParticipations()[0]->getUtilisateur());

var_dump($par->getUtilisateur()->getParticipations()[0]->getUtilisateur()->getParticipations()[0]->getUtilisateur()->getParticipations()[0]->getUtilisateur()->getParticipations()[0]->getUtilisateur()->getParticipations()[0]->getUtilisateur()->getParticipations()[0]->getUtilisateur()->getParticipations()[0]->getUtilisateur()->getParticipations()[0]->getUtilisateur()->getParticipations());
