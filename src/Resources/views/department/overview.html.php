<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */
$view->extend('department/layout.html.php');

$view['slots']->set('department', $department);

?>
<?= sprintf(
        'Department manager is <strong>%s</strong> (%s)',
        $department->getManager(),
        $department->getManager()->getEmail())?>