<?php

use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var GlobalVariables $app
 * @var RequestHelper $request
 * @var array $parent
 */

$request = $app->getRequest();
$current = $current ?? '';

?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/">Home</a>
    </li>
    <?php if ($parent) :?>
        <li class="breadcrumb-item">
            <a href="<?=$parent['pageUrl']??''?>"><?=$parent['pageTitle']??''?></a>
        </li>
    <?php endif;?>
    <li class="breadcrumb-item active"><?= $current?></li>
</ol>
<div class="clearfix"></div>


