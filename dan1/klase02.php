<?php

class Datum{

    public $dan = 'Ponedjeljak';
}

// Instanciranje objekata
$datum = new Datum();
echo $datum->dan; //prisup properties-ima
echo '<br>';

$datum->dan = 'Utorak'; // dodavanje nove vrijednosti
echo $datum->dan;
echo '<br>';
echo '<br>';


$datum2 = new Datum();
echo $datum2->dan;

?>