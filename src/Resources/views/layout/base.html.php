<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Human resource management system">
        <meta name="author" content="nauris.kruzkops@gmail.com">
        <title>Crocolab HRMS (Human resource management system)</title>
        <link href="<?= $view['assets']->getUrl('/assets/vendor/bootstrap/css/bootstrap.min.css', 'vendor') ?>" rel="stylesheet">
        <link href="<?= $view['assets']->getUrl('/assets/vendor/bootstrap-datepicker/bootstrap-datetimepicker.min.css', 'css') ?>" rel="stylesheet">
        <link href="<?= $view['assets']->getUrl('/assets/vendor/font-awesome/css/font-awesome.min.css', 'vendor') ?>" rel="stylesheet" type="text/css">
        <link href="<?= $view['assets']->getUrl('/assets/css/theme-base.css', 'css') ?>" rel="stylesheet">
        <link href="<?= $view['assets']->getUrl('/assets/css/bootstrap-overwrite.css', 'css') ?>" rel="stylesheet">
        <link href="<?= $view['assets']->getUrl('/assets/css/tools.css', 'css') ?>" rel="stylesheet">
        <link href="<?= $view['assets']->getUrl('/assets/css/calendar.css', 'css') ?>" rel="stylesheet">
        <link href="<?= $view['assets']->getUrl('/assets/css/calendar-timetable.css', 'css') ?>" rel="stylesheet">

        <script src="<?= $view['assets']->getUrl('/assets/vendor/jquery/jquery.min.js', 'vendor') ?>"></script>
        <script src="<?= $view['assets']->getUrl('/assets/vendor/popper.min.js', 'vendor') ?>"></script>
        <script src="<?= $view['assets']->getUrl('/assets/vendor/bootstrap/js/bootstrap.min.js', 'vendor') ?>"></script>
    </head>
    <body class="fixed-nav">

        <div id="wrapper">
            <?php $view['slots']->output('_content') ?>
        </div>

        <script src="<?= $view['assets']->getUrl('/assets/vendor/moment.min.js', 'vendor') ?>"></script>
        <script src="<?= $view['assets']->getUrl('/assets/vendor/bootstrap-datepicker/bootstrap-datetimepicker.min.js', 'vendor') ?>"></script>
        <script src="<?= $view['assets']->getUrl('/assets/js/main.js', 'js') ?>"></script>
    </body>
</html>


