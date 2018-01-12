<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */
?><div class="card mb-3">
    <?php if(isset($title)) :?>
        <div class="card-header">
            <?php if(isset($icon)) :?>
                <i class="<?= $icon?>"></i>
            <?php endif; ?>
            <?= $title?>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <?php $view['slots']->output('_content') ?>
    </div>
    <?php if(isset($footer)) :?>
        <div class="card-footer small text-muted">
            <?= $footer?>
        </div>
    <?php endif; ?>
</div>