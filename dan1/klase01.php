<?php

class Covjek {
    //svojstva
    public $ime;
    public $godine;
    protected $visina;
    private $masa;

    //metode
    private function sjedenje(){

    }

    private function razmisljanje(){

    }
}

//instanciranje objekata
$objekt = new Covjek(); //vraća objekt iz klase
$covjek = new Covjek();
$aleksandar = new Covjek();
$ivan = new Covjek(); // podaci se upisuju u objekt

class Automobil{

    private $br_kotaca;
    private $boja;
    private $kilometraza;
    private $brzina;

    public function prevozi(){

    }

    public function pumpam_ego(){

    }
}

class SUV extends Automobil { // nasljeđivanje - extends, uz objekte iz automobila, ima nove objekte i funkcije koje se razlikuju od prvog objekta

        private $pogon_na_4_kotača;

        private function strmi_uspon(){

    }
}

class SportsCar extends Automobil{

}

?>