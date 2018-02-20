<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */
$view->extend('employee/layout.html.php');

$view['slots']->set('employee', $employee);
?>

...