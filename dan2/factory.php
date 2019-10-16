<?php

abstract class AnimalAbstract{

    protected $vrsta;

    public function getVrsta(){
        return $this->vrsta;
    }
}

class Cat extends AnimalAbstract{

    protected $vrsta = 'Micamaca';
}

class Dog extends AnimalAbstract{

    protected $vrsta = 'Peso';
}

class Elephant extends AnimalAbstract{

    protected $vrsta = 'Slonek';
}

class AnimalFactory{

    public static function factory($animal){

        switch ($animal) {
            case 'Micamaca':
                $obj = new Cat();
                break;
            case 'Peso':
                $obj = new Dog();
                break;
            case 'Slonek':
                $obj = new Elephant();
                break;
            default:
                throw new Exception("Ne mogu instancirati životinju vrste $animal.", 400); // u slučaju da korisnik napiše krivu riječ, npr. cxat
                
        }
        return $obj;
    }
}

try {
    $cat = AnimalFactory::factory('Micamaca');
    echo "<p>". $cat->getVrsta(). "</p>";

    $dog = AnimalFactory::factory('Peso');
    echo "<p>". $dog->getVrsta(). "</p>";

    $elephant = AnimalFactory::factory('Slonek');
    echo "<p>". $elephant->getVrsta(). "</p>";

    $snake = AnimalFactory::factory('snake'); // ovdje će izbaciti exception

} catch (Exception $e) {
    echo "Error code: ". $e->getCode();
    echo $e->getMessage();
}

