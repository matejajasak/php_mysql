<?php

class User {

    private $ime;
    private $prezime;

    public function __construct($ime, $prezime){
        $this->ime = $ime;
        $this->prezime = $prezime;
    }

    public function ispis(){
        echo "Ime: $this->ime Prezime: $this->prezime";
    }

}

$korisnik = new User('Marko', 'Markić');
$korisnik->ispis();