<?php

class Validation{

    private $db;
    private $errors = array();
    private $passed = false;

    public function __construct(){
        $this->db = DB::getInstance();
    }

    public function check($items = array()){
        foreach ($inputs as $input => $rules) {
            foreach ($rules as $rule => $rule_value) {
                
                $input_value = escape(trim(Input::get($input)));

                if ($rule === 'required' && empty($input_value)) {
                    $this->addError($input, "Field $input is required.");
                }elseif(!empty($input_value)){
                    switch ($rule) {
                        case 'min':
                            if (strlen($input_value) < $rule_value) {
                                $this->addError($input, "Field $input must have minimum od $rule_value characters.")
                        break;
                        
                        case 'max':

                        break;
                        case 'unique':

                        break;
                        case 'matches':

                        break;
                        case 'pattern':

                        break;

                    }
                }
            }
        }
    }

    private function addError($input, $error){
        $this->errors[$input] = $error;
    }

    public function hasError($input){ //ovdje se ispisuju crvena slova da se popune polja
        if (isset($this->errors[$input])){
            return $this->errors[$input];
        }
        return false;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function passed(){
        return $this->passed;
    }
}