<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */

?><div>
    <?php $view['slots']->output('_content') ?>
</div>