<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */
?>
<?php foreach ($view['session']->getFlashes() as $type => $flash_messages): ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 alert alert-success">
            <?php foreach ($flash_messages as $flash_message): ?>
                <div class="flash-<?= $type ?>">
                    <?= $flash_message ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php endforeach ?>
