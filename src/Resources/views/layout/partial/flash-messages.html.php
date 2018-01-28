<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */
?>
<?php foreach ($view['session']->getFlashes() as $type => $flash_messages): ?>
    <?php
        $alertType = 'alert-success';
        if ($type == 'error') {
            $alertType = 'alert-danger';
        }
    ?>
    <div class="row">
        <div class="offset-sm-3 col-sm-6 alert <?= $alertType?> alert-dismissible fade show" role="alert">
            <?= '- '.implode('<br>- ', $flash_messages)?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
<?php endforeach ?>
