<?php

require_once 'core/init.php';

Helper::getHeader();

$users = DB::getInstance()->query('SELECT u.id, u.name, u.username, u.joined, r.name AS rola FROM users u JOIN roles r ON r.id = u.role_id')->results();

include_once 'notifications.php';

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card m-5">
            <h5 class="card-title p-2">Korisnici</h5>
            <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Username</th>
                        <th>Rola</th>
                        <th>Datum registracije</th>
                        <th>Akcija</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($users as $key => $user) {
                    //$rola = DB::getInstance()->select('name', 'roles', ['id', '=', $user->role_id])->first();
                    echo
                        "<tr>
                            <td>$user->id</td>
                            <td>$user->name</td>
                            <td>$user->username</td>
                            <td>$user->rola</td>
                            <td>$user->joined</td>
                            <td>
                                <a href='show-user.php?id=$user->id' class='btn btn-sm btn-primary'>Prikaži</a>
                                <a href='edit-user.php?id=$user->id' class='btn btn-sm btn-success'>Uredi</a>
                                <a href='remove-user.php?id=$user->id' class='btn btn-sm btn-danger'>Obriši</a>
                            </td>
                        </tr>";
                }
                ?>
                
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php

Helper::getFooter();

?>
