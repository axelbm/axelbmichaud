<?php

namespace core;

class FormView {
    public $id;
    public $form;

    public function __construct(string $action) {
        $info = MainForm::nouveauFormId($action);
        $this->id = $info[0];
        $pos = $info[1];

        $form = MainForm::getInstance();

        if (isset($form) && $form->getPosition() == $pos) {
            $this->form = $form;
        }
    }

    public function get($cle) : ?string {
        if (isset($this->form)) {
            if (\property_exists($this->form, $cle)) {
                return $this->form->$cle;
            }
        }

        return null;
    }

    public function erreur($cle) : ?string {
        if (isset($this->form)) {
            if (\property_exists($this->form, $cle)) {
                return $this->form->getErreur($cle);
            }
        }

        return null;
    }
}