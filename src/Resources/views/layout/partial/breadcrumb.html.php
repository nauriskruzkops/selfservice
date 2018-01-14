<?php

use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var GlobalVariables $app
 * @var RequestHelper $request
 */

$request = $app->getRequest();
$attributes = $request->attributes->get('_route'); // ToDO : empty?

?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/">Home</a>
    </li>
    <li class="breadcrumb-item active"><?= $attributes?></li>
</ol>
<div class="clearfix"></div>


