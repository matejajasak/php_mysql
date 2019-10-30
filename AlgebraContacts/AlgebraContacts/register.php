<?php

require_once 'core/init.php';

Helper::getHeader();

$validation = new Validation();

if (Input::exists()) {

    $validate = $validation->check([
        'name'      => [
           'required' => true,
           'min'      => 2,
           'max'      => 30
        ],
        'username'  => [
            'required' => true,
            'min'      => 2,
            'max'      => 30,
            'unique'   => 'users'
        ],
        'password'  => [
            'required' => true,
            'min'      => 7,
            'pattern'  => true
        ],
        'password_confirmation'  => [
            'required' => true,
            'matches'  => 'password',
        ]
    ]);
   
    if($validate->passed()){

        $salt = Hash::salt();
        $password = Hash::make(Input::get('password'), $salt);

        try {

            DB::getInstance()->insert('users',[
                'name'     => Input::get('name'),
                'username' => Input::get('username'),
                'password' => $password,
                'salt'     => $salt,
                'role_id'  => 3
            ]);
    } catch (Exception $e){
        Session::flash('danger', $e->getMessage());
        Redirect::to('register');
        return false;
    }
    Session::flash('success', 'You registred successfully');
    Redirect::to('all-users');
}

}

include_once 'notifications.php';

?>

<div class="row m-5">
    <div class="card col-lg-6 offset-lg-3">
    <h5 class="card-title pt-3">Create an account</h5>
    <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control <?php echo $validation->hasError('name') ? 'is-invalid' : '' ?> 'is-invalid'" id="name" name="name" placeholder="Enter your full name">
                    <?php echo $validation->hasError('name') ? '<p class=text-danger>'. $validation->hasError('name') . '</p>' : '' ?>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control <?php echo $validation->hasError('username') ? 'is-invalid' : '' ?> 'is-invalid'" id="username" username="username" placeholder="Enter your username">
                    <?php echo $validation->hasError('username') ? '<p class=text-danger>'. $validation->hasError('username') . '</p>' : '' ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" <?php echo $validation->hasError('password') ? 'is-invalid' : '' ?> id="password" placeholder="Choose Password">
                    <?php echo $validation->hasError('password') ? '<p class=text-danger>'. $validation->hasError('password') . '</p>' : '' ?>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password_confirmation" class="form-control" <?php echo $validation->hasError('password_confirmation') ? 'is-invalid' : '' ?> id="password_confirmation" placeholder="Choose your Password">
                    <?php echo $validation->hasError('password_confirmation') ? '<p class=text-danger>'. $validation->hasError('password_confirmation') . '</p>' : '' ?>
                </div>

                <div class="form-group ">
                <button type="submit" class="btn btn-primary" style="float:right">Create an Account</button>
                </div>

                <div class="form-group ">
                <a href="index.php" class="btn btn-secondary">Back</a>
                </div>      
            </form>
        </div>
    </div>
</div>



<?php

Helper::getFooter();

?>