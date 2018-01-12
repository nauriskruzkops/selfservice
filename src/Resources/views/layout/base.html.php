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
        <meta name="description" content="">
        <meta name="author" content="">
        <title>CMS</title>
        <link href="<?= $view['assets']->getUrl('/assets/vendor/bootstrap/css/bootstrap.min.css', 'vendor') ?>" rel="stylesheet">
        <link href="<?= $view['assets']->getUrl('/assets/vendor/font-awesome/css/font-awesome.min.css', 'vendor') ?>" rel="stylesheet" type="text/css">
        <link href="<?= $view['assets']->getUrl('/assets/theme/sb-admin.css', 'sbadmin') ?>" rel="stylesheet">
        <link href="<?= $view['assets']->getUrl('/assets/css/calendar.css', 'css') ?>" rel="stylesheet">
        <link href="<?= $view['assets']->getUrl('/assets/css/calendar-timetable.css', 'css') ?>" rel="stylesheet">

    </head>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <?php $view['slots']->output('_content') ?>
        <script src="<?= $view['assets']->getUrl('/assets/vendor/jquery/jquery.min.js', 'vendor') ?>"></script>
        <script src="<?= $view['assets']->getUrl('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', 'vendor') ?>"></script>
        <script src="<?= $view['assets']->getUrl('/assets/vendor/jquery-easing/jquery.easing.min.js', 'vendor') ?>"></script>
        <script src="<?= $view['assets']->getUrl('/assets/theme/sb-admin.js', 'sbadmin') ?>"></script>
    </body>
</html>


