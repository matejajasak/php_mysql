<?php

require_once 'core/init.php';

Helper::getHeader();

$users = DB::getInstance()->select('*','users')->results();

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
                        <th scope="col">ID</th>
                        <th scope="col">Ime</th>
                        <th scope="col">Username</th>
                        <th scope="col">Rola</th>
                        <th scope="col">Datum registracije</th>
                        <th scope="col">Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($users as $key => $user) {
                        echo
                            "<tr>
                                <td>$user->id</td>
                                <td>$user->name</td>
                                <td>$user->username</td>
                                <td>$user->role_id</td>
                                <td>$user->joined</td>
                                <td>
                                    <a href='show-user.php?id=$user->id' class='btn btn-sm btn-primary'>Prikaži</a>
                                    <a href='edit-user.php?id=$user->id' class='btn btn-sm btn-success'>Uredi</a>
                                    <a href='remove-user.php?id=$user->id' class='btn btn-sm btn-danger'>Obriši</a>
                                </td>
                            </tr>";
                    }
                       
                    ?>
                    
                        <tr>
                       
                        </tr>
                        <tr>
                      
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php

Helper::getFooter();

?>
