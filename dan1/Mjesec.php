<?php

include 'Datum.php';

class Mjesec extends Datum{

    private $mjeseci = array('Siječanj', 'Veljača', 'Ožujak');

    public function getMonthName($date){
        $mjesec = date('n', strtotime($date));
        $mjesec--;
        $ime_mjeseca = $this->mjeseci[$mjesec];
        //return $ime_mjeseca;
        return "Tada je dan " . $this->getDayName($date) . " u mjesecu $ime_mjeseca";

    }

}

$mjesec = new Mjesec();
echo $mjesec->getMonthName('2019-2-15');