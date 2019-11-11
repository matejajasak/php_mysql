<?php

require_once 'core/init.php';

Helper::getHeader();

include_once 'notifications.php';

$validation = new Validation();

if (Input::exists('get')) {
    $userId = Input::get('id'); 
    $user = DB::getInstance()->getById('*', 'users', $userId)->first();
    $roles = DB::getInstance()->select('*','roles')->results();
}

if (Input::exists()) {
    $userId = Input::get('id');
    $user = DB::getInstance()->getById('*', 'users', $userId)->first();

    if (Input::get('password')) {
        $salt = DB::getInstance()->select('salt', 'users', ['id', '=', $userId])->first()->salt;
        $password = Hash::make(Input::get('password'), $salt);
    
    }else {
        $password = DB::getInstance()->select('password', 'users', ['id', '=', $userId])->first()->password;
    }


    $user = DB::getInstance()->update('users', $userId, [
        'username'  => Input::get('username'), 
        'name'  => Input::get('name'), 
        'password'  => $password,
        'role_id'   =>Input::get('user-roles')
    ]);

    if ($user->error()) {
        Session::flash('danger', 'There was problem editing user.');
        Redirect::to('all-user');
    }else {
        Session::flash('success', 'You have successfully edited user.');
        Redirect::to('all-users');
        
    }
    $user = DB::getInstance()->getById('*', 'users', $userId)->first();
}

?>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card m-5">
            <h5 class="card-title p-2">Edit user <?php echo $user->name ?></h5>
            <div class="card-body">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $user->id ?>">
                <input type="hidden" name="token" value="<?php echo Token::factory()->generate() ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control <?php echo $validation->hasError('name') ? 'is-invalid' : '' ?>" id="name" name="name" value="<?php echo $user->name ?>">
                    <?php echo $validation->hasError('name') ? '<p class=text-danger>'. $validation->hasError('name') . '</p>' : '' ?>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control <?php echo $validation->hasError('username') ? 'is-invalid' : '' ?>" id="username" name="username" value="<?php echo $user->username ?>">
                    <?php echo $validation->hasError('username') ? '<p class=text-danger>'. $validation->hasError('username') . '</p>' : '' ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control <?php echo $validation->hasError('password') ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Ako ne želite promijeniti password, ostavite prazno polje">
                    <?php echo $validation->hasError('password') ? '<p class=text-danger>'. $validation->hasError('password') . '</p>' : '' ?>
                </div>

                <div class="form-group">
                <label for="user-roles">Roles</label>
                <select class="custom-select" name="user-roles" id="user-roles"> 
                    <?php
                        foreach ($roles as $key => $role) {
                    ?>
                        <option <?php $user->role_id === $role->id ? print 'selected' : print '' ?> value="<?php echo $role->id ?>"><?php echo $role->name ?></option>
                                            
                    <?php
                    }
                    ?>
                </select>
                </div>
                <a href="all-users.php" class="btn btn-info">Back</a>
                <input type="hidden" name="id" value=" <?php echo $userId?>">
                <button type="submit" name="submit" class="btn btn-primary" style="float:right">Edit</button>
            </form>
            </div>
        </div>
    </div>
</div>


<?php

Helper::getFooter();

?>
