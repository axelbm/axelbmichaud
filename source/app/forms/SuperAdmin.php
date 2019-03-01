<?php

namespace app\forms;

use core\DAO;

class SuperAdmin extends \core\Form {
    /** @var string */
    public $courriel;
    /** @var bool */
    public $admin;

    /** @var \app\modeles\Utilisateur */
    private $utilisateur;

    public function valider (){
        $this->admin = $this->admin=="true" ? true : false;


        $administrateur = \app\outils\Session::getUtilisateur();
        if(!$administrateur->estSuperAdministrateur()){
            $this->ajouterErreur("courriel", "Fonction réservé au Superadmin.<br>Vous n'avez pas suffisament de droit.");
        }

        if (!$this->validerChamp("Courriel", $this->courriel)) {
            $this->ajouterErreur("courriel", "Courriel invalide");
        }

        $this->utilisateur = \core\DAO::Utilisateur()-> find($this->courriel);

        if ($this->utilisateur) {
            if ($this->utilisateur->estSuperAdministrateur()) {
                $this->ajouterErreur("courriel", "Cet utilisateur est Supercourriel.<br>Vous ne pouvez pas changer ses droits.");
            }
            elseif($this->utilisateur->estAdministrateur() && $this->admin){
                $this->ajouterErreur("courriel", "Cet utilisateur a déjà ces droit.");
            }
            elseif(!$this->utilisateur->estAdministrateur() && !$this->admin){
                $this->ajouterErreur("courriel", "Cet utilisateur a déjà ces droit.");
            }
        }
        else {
            $this->ajouterErreur("courriel", "L'utilisateur n'existe pas.");
        }
    }

    public function action() {
        if ($this->admin == true){
            $this->utilisateur->setAdministrateur(1);

            \app\outils\Notification::ajouterPopup("Succes", "Les droits d'administration on bien été donné à ".$this->utilisateur->getNomComplet().".",["tail"=>"sm"]);
        }
        elseif($this->admin == false){
            $this->utilisateur->setAdministrateur(0);

            \app\outils\Notification::ajouterPopup("Succes", "Les droits d'administration on bien été retiré à ".$this->utilisateur->getNomComplet().".",["tail"=>"sm"]);
        }
        $this->utilisateur->sauvegarder();

        \core\MainControleur::rediriger();
    }
}