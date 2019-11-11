<?php

require_once 'core/init.php';

Helper::getHeader();

include_once 'notifications.php';

if (Input::exists('get')) {
    $userId = Input::get('id'); 
    $user = DB::getInstance()->getById('*', 'users', $userId)->first();
}

if (Input::exists()) {
    $userId = Input::get('id');
    $user = DB::getInstance()->delete('users', ['id', '=', $userId]);

    if ($user->error()) {
        Session::flash('danger', 'There was problem deleting user.');
        Redirect::to('remove-users');
        
    }else {
        Session::flash('success', 'You have successfully deleted user.');
        Redirect::to('all-users');
        
    }
}

?>

<div class="row">
    <div class="col-lg-6 offser-lg-3">
        <div class="card m-5">
            <h5 class="card-title p-2">Jeste li sigurni da želie obrisati korisnika <?php echo $user->name ?>?</h5>
            <div class="card-body">
            <p>Ime: <?php echo $user->name ?></p>
            <p>Username: <?php echo $user->username ?></p>
            <p>Rola: <?php echo $user->role_id ?></p>
            <p>Datum registracije: <?php echo $user->joined ?></p>
            <form method="POST">
                <a href="all-users.php" class="btn btn-info">Back</a>
                <input type="hidden" name="id" value=" <?php echo $userId?>">
                <button type="submit" name="submit" class="btn btn-primary" style="float:right">Potvrdi</button>
            </form>
            </div>
        </div>
    </div>
</div>


<?php

Helper::getFooter();

?>
