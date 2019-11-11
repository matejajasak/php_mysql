<?php

require_once 'core/init.php';

Helper::getHeader();

// DZ napraviti validaciju za login kao u register

$validation = new Validation();
$user = new User();

if (Input::exists()) {
    if (Token::factory()->check(Input::get('token'))) {

    $validate = $validation->check([
        'username'  => [
            'required'  => true,
            //'matches'   => 'users' - može i ovo
        ],
        'password'   => [
            'required'  => true,
        ]
    ]);

    if($validate->passed()){

        $remember = (bool)Input::get('remember');
        $login = $user->login(Input::get('username'), Input::get('password'), $remember);

       if ($login) {
        Redirect::to('dashboard');
       }else {
        Session::flash('danger', 'Sorry, login failed! Please try again!');
        Redirect::to('login');
       }
    }
}
}
include_once 'notifications.php';
/*
        Session::flash('success', 'You registred successfully');
        Redirect::to('all-users');
        */
    

?>

<div class="row m-5">
    <div class="card col-lg-6 offset-lg-3">
        <h5 class="card-title pt-3">Log in</h5>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="token" value="<?php echo Token::factory()->generate() ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Choose password">
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <div class="form-group">
                    <a href="index.php" class="btn btn-info">Back</a>
                    <button type="submit" class="btn btn-primary" style="float:right">Log in</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<?php

Helper::getFooter();

?>
