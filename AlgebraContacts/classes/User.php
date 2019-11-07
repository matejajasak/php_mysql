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

        public function login($username = null, $password = null, $remember = null){

            if (!$username && !$password && $this->exists()) {
                Session::put($this->config['session']['session_name'], $this->data->id);
            }else {
                $userExists = $this->find($username);
                if ($userExists) {
                    if($this->data->password === Hash::make($password, $this->data->salt)){
                        Session::put($this->config['session']['session_name'], $this->data->id);
    
                        if ($remember) {
                            // provjeravamo postoji li zapis u bazi u tablici sessions za tog korisnika 
                            $cookieExists = $this->db->select('hash', 'sessions', ['user_id', '=', $this->data->id]);
    
                            // ako ne postoji upisujemo ga u sessions tablicu
                            if (!$cookieExists->count()) {
                                $hash = Hash::unique();
                                $this->db->insert('sessions', [
                                    'user_id' => $this->data->id, 
                                    'hash'    => $hash
                                ]);
                            }else {
                                $hash = $cookieExists->first()->hash;
                            }
                            Cookie::put($this->config['cookie']['cookie_name'], $hash, $this->config['cookie']['cookie_expiery']);
                        }
    
                        return true;
                    }else {
                        Session::flash('danger', 'Wrong password!');
                        Redirect::to('login');
                    }
                }else {
                        Session::flash('danger', 'This username does not exist in our database!');
                        Redirect::to('login');
                }
            }
        }



        public function logout(){
            $this->db->delete('sessions', ['user_id', '=', $this->data->id]);
            Cookie::delete($this->config['cookie']['cookie_name']);
            Session::delete($this->config['session']['session_name']);
            session_destroy();
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