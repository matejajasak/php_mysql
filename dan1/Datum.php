<?php

class Datum{

    private $dani = array('Pon', 'Uto', 'Sri', 'Čet','Pet', 'Sub', 'Ned');
    
    public function getDayName($date){
        $dan = date('N', strtotime($date));
        $dan--;
        $ime_dana = $this->dani[$dan];
        return $ime_dana;
    }
}

//$datum = new Datum();
//echo $datum->getDayName('2019-10-16');