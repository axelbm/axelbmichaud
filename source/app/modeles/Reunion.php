<?php

namespace app\modeles;

use \core\Modele;

use \app\dao\Reunion as dao;

class Reunion extends Modele {
    /** @var int */
    protected $reunionid;

    /** @var \Datetime */
    protected $date;

    /** @var string */
    protected $createur;

    /** @var string */
    protected $statutid;

    public function __construct(\DateTime $date=null, string $createur=null, string $statutid="Ave") {
        $this->date = $date;
        $this->createur = $createur;
        $this->statut = $statutid;
    }

    /**
     * Undocumented function
     *
     * @param Utilisateur $user
     * @return Invitation
     */
    public function inviterUtilisateur(Utilisateur $user) : Invitation {
        throw(new \Exception("Pas implementé"));
    }

    /**
     * Undocumented function
     *
     * @param PointDordre $point
     * @return void
     */
    public function ajouterPointDordre(PointDordre $point) {
        throw(new \Exception("Pas implementé"));
    }

    public function estCreateur(Utilisateur $utilisateur) : bool {
        return $this->createur == $utilisateur->getCourriel();
    }

    public function nbInvite() : int {
        return count($this->getParticipations());
    }

    public function annuler() {
        $this->statut = false;
        $this->sauvegarder();
    }


    public function mettreAJourStatut() {
        $pointdordres = $this->getPointDordres();
        $termine = count($pointdordres) > 0;

        if ($this->getStatutId() != "Ann") {
            foreach($pointdordres as $pointdordre) {
                if ($pointdordre->getCompteRendu() == "") {
                    $termine = false;
                    break;
                }
            }

            if ($termine) {
                $this->setStatutId("Term");
            }
            else {
                if ($this->getDate() < new \DateTime()) {
                    $this->setStatutId("Ret");
                }
                else {
                    $this->setStatutId("Ave");
                }
            }

            $this->sauvegarder();
        }

        $this->mettreAJourParticipation();
    }

    public function mettreAJourParticipation() {
        $participations = $this->getParticipations();

        foreach ($participations as $participation){
            if ($this->getStatutId() == "Term") {
                if ($participation->getStatutID() == "EnAt" || $participation->getStatutID() == "Hes") {
                    $participation->setStatutID("Abs");
                    $participation->sauvegarder();
                }
            }
            elseif ($this->getStatutId() == "Ann") {
                if ($participation->getStatutID() != "Org") {
                    $participation->setStatutID("Ann");
                    $participation->sauvegarder();
                }
            }
        }
    }

    public function peutModifier() : bool {
        return $this->getStatutId() != "Ann" && $this->getStatutId() != "Term";
    }

    public function peutAjouter() : bool {
        return $this->peutModifier() && $this->getStatutId() != "Ret";
    }
}