<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */
?><ul class="list-group">
    <?php $view['slots']->output('_content') ?>
</ul>
