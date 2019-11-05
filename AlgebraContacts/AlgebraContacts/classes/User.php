<?php

    class User{

        private $config;
        private $db;
        private $data;
        private $isLoggedIn = false;

        public function __construct($user = null){

            $this->db = DB::getInstance();
            $this->config = Config::get('session');
            $s_name = ($this->config['session']['session_name']);

            if (!$user) {
                if (Session::exists($s_name)) {
                    $user = Session::get($s_name);

                    if ($this->find($user)) {
                        $this->isLoggedIn = true;
                    }else {
                        $this->isLoggedIn = false;
                    }
                }
            }else {
                $this->find($user);
            }

        }

        public function create($fields = array()){

        }

        public function find($user = null){

            if ($user) {
                $field = is_numeric($user) ? 'id' : 'username';
                $data = $this->db->select('*', 'users', [$field, '=', $user]);

                if ($data->count()) {
                    $this->data = $data->first();
                    return true;
                }
            }
            return false;
        }

        public function login($username = null, $password = null){

            $userExists = $this->find($username);
            if ($userExists) {
                if($this->data->password === Hash::make($password, $this->data->salt)){
                    Session::put($this->config['session']['session_name'], $this->data->id);
                    return true;
                }
            }
        }

        public function logout(){

        }

        public function exists(){
            return !empty($this->data) ? true : false;
        }

        public function check(){
            return $this->isLoggedIn;
        }

        public function data(){
            return $this->data;
        }
    }


?>