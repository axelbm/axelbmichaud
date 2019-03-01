<?php

namespace app\modeles;

use \core\Modele;

use \app\dao\Utilisateur as dao;

class Utilisateur extends Modele {
    /** @var string */
    protected $courriel;
    
    /** @var string */
    protected $nom;
    
    /** @var string */
    protected $prenom;
    
    /** @var string */
    protected $motdepasse;
    
    /** @var int */
    protected $administrateur;

    public function __construct(string $courriel="", string $nom="", string $prenom="", string $motdepasse="", int $administrateur=0) {
        $this->courriel = $courriel;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->setMotDePasse($motdepasse);
        $this->administrateur = $administrateur;
    }


    /**
     * Valide le mot de passe de l'utilisateur
     *
     * @param string $pass
     * @return boolean
     */
    public function validerMotDePasse (string $pass) : bool {
        // Hash automatiquement le mot de passe et le sauvegarde
        $info = password_get_info ($this->motdepasse);
        if ($info['algoName'] == 'unknown') {
            $this->setMotDePasse($this->motdepasse);
            $this->sauvegarder();
        }

        // verification du mdp
        return password_verify($pass, $this->motdepasse);
    }

    /**
     * Retourne le nom complete de l'utilisateur selon le format demandé.
     * (0) Prénom Nom, (1) Nom Prénom, (2) P.A.
     *
     * @param integer $format
     * @return string
     */
    public function getNomComplet (int $format = 0) : string{
        switch($format){
            case 1:
                return "$this->nom $this->prenom";
            case 2:
                return \substr($this->prenom,0,1).".".\substr($this->nom,0,1).".";
            default:
                return "$this->prenom $this->nom";
        }
    }

    public function onSetMotDePasse($old, $new) {
        return password_hash($new, PASSWORD_DEFAULT);
    }

    public function estAdministrateur() : bool {
        return $this->administrateur >= 1;
    }

    public function estSuperAdministrateur() : bool {
        return $this->administrateur == 2;
    }
}
