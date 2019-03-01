<?php

use \core\DAO;

// $reunions = new \app\modeles\Reunion(new \DateTime(), "axel@gmail.com");
// $reunions->sauvegarder();
// $reunions = new \app\modeles\Reunion(new \DateTime(), "aléo@hotmail.com");
// $reunions->sauvegarder();
// $reunions = new \app\modeles\Reunion(new \DateTime(), "aalexia@gmail.com");
// $reunions->sauvegarder();

// var_dump(DAO::Reunion()->find(1));



// var_dump(DAO::Utilisateur());


$u = DAO::Utilisateur()->find("axel@gmail.com");

var_dump($u->getMotDePasse());
var_dump($u->validerMotDePasse('password'));
$u->setMotDePasse("password");
var_dump($u->getMotDePasse());
var_dump($u->validerMotDePasse('asd'));

//DAO::Reunion()->getPageParUtilisateur($u);

//var_dump($u);

// $u->setNom("B Michaud");

// $u->sauvegarder();

// var_dump($u);

// je sys asdf rqwe;

// \app\dao\Utilisateur::select("ORDER BY nom");


// $user = new modeles\Utilisateur("francois@gmail.com", "Jesaispas", "François", "mdp", false);
// $user->sauvegarder();

// $user->setNom("B Michaud");

// $user->setNom("Michaud");

// $user->sauvegarder();

// var_dump($user->getPrimaryKeys());


// $user = \app\dao\Utilisateur::find("francois@gmail.com");


// $user->supprimer();


// dao\Utilisateur::supprimer("axel@gmail.com");

// var_dump($user);
