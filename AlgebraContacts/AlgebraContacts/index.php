<?php

require_once 'core/init.php';

$user = new User();

Helper::getHeader();

?>


<div class="jumbotron mt-4">
    <h1 class="display-4"><?php echo Config::get('app')['name'] ?></h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <a class="btn btn-primary btn-lg" href="login.php" role="button">Sign In</a>
    <a class="btn btn-success btn-lg" href="register.php" role="button">Create an account</a>
</div>


<?php

Helper::getFooter();

?>
