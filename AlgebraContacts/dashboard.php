<?php

require_once 'core/init.php';

Helper::getHeader();

$user = new User();

if (!$user->check()) {
    Redirect::to('index');
}

require_once 'notifications.php';

?>

<h1>Dashboard</h1>

<?php

Helper::getFooter();

?>
