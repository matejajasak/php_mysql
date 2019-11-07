<?php

class Validation{

    private $db;
    private $errors = array();
    private $passed = false;

    public function __construct(){
        $this->db = DB::getInstance();
    }

    public function check($inputs = array()){
        foreach ($inputs as $input => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $input_value = escape(trim(Input::get($input)));

                if ($rule === 'required' && empty($input_value)) {
                    $this->addError($input, "Field $input is required.");
                }elseif(!empty($input_value)){
                    switch ($rule) {
                        case 'min':
                            if (strlen($input_value) < $rule_value ) {
                                $this->addError($input, "Field $input must have minimum of $rule_value characters.");
                            }
                            break;
                        case 'max':
                            if (strlen($input_value) > $rule_value ) {
                                $this->addError($input, "Field $input must have maximum of $rule_value characters.");
                            }
                            break;
                        case 'unique':
                        // SELECT * FRM users WHERE username = $input_value
                            $check = $this->db->select('*', $rule_value, [$input, '=', $input_value]);
                            if($check->count()){
                                $this->addError($input, "$input $input_value already exists.");
                            }
                            break;
                        case 'matches':
                            # DZ - provjeriti da li se polje password i polje password_confirmation
                            # podudaraju, ako  ne upisati grešku
                            # pripazit da vrijedi za sve forme!!!

                            /*if($input_value != Input::get($rule_value)){
                                $this->addError($input, "Field $input must match field $rule_value.");
                            }*/
                            break;
                        case 'pattern':
                        
                            /*if (!preg_match(Config::get('app')['register_password_regex'], $input_value)) {
                                $this->addError($input, "Field $input must include at least one Upper case and one Lower case, one number and one special character.");
                            }*/
                            // DZ - provjeriti uvjet za password sa php ugradenim funkcijama
                            // ctype_alnum()
                            /*
                            $sve_brojevi = ctype_digital($input_value);
                            $sve_lowercase = cytpe_lower($input_value);
                            
                            if(!$sve_brojevi && !$sve_lowercase){
                                // znači da je korisnik upotrijebio velika slova i nešto više od brojeva

                            }
                            */

                            break;
           
                    }
                }
            }
        }
        if (empty($this->errors)) {
            $this->passed = true;
        }

        return $this;
    }

    private function addError($input, $error){
        $this->errors[$input] = $error;
    }

    public function hasError($input){
        if (isset($this->errors[$input])) {
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