<?php

class Datum{

    /* pristup je moguć samo unutar klase */
    private $dan = 'Utorak';
    /* pristup je moguć unutar klase i u nasljeđenim klasama */
    protected $mjesec = 'Listopad';
    /* pristup je moguć izvan klase */
    public $godina = 2019;

    public function print(){
        echo $this->dan;
        echo $this->mjesec;
        echo $this->godina;
    }
}

$datum = new Datum();

//var_dump($datum);


echo $datum->dan;
echo $datum->mjesec;
echo $datum->godina;


?>