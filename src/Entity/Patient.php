<?php

namespace App\Entity;

class Patient {
    public $surname;
    public $firstname;
    public $birthdate;
    public $gender;

    public function __construct($surname, $firstname, $birthdate, $gender)
    {
        $this->surname = $surname;
        $this->firstname = $firstname;
        $this->birthdate = $birthdate;
        $this->gender = $gender;        
    }
}