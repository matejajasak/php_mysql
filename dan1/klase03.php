<?php

class Datum{

    private $dan;

    public function set_dan($dan){
        $this->$dan = $dan;
    }

    public function get_dan(){
        return $this->dan; // this je ključna riječ koja se odnosi na klasu. Pogledaj unuar klase, pronađi propeties dan
    }
}

$datum = new Datum();
$datum->set_dan('Utorak');
echo $datum->get_dan();

?>