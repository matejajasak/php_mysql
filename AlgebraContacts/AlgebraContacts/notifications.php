<?php

require_once 'core/init.php';

$sessions = Session::all();

foreach ($sessions as $key => $msg) {
    switch ($key) {
        case 'success':
        case 'danger':
        case 'info':
        case 'warning':
?>
        <div class="row">
            <div class="clo-lg-12">
                <div class="alert alert-<?php echo $key ?> alert-dismissible fade show" role="alert">
                    <?php echo $msg ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>


<?php
        Session::delete($key);
        break;
        
    }
}

?>