<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */
$view->extend('layout/base.html.php');

?><div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Password recovery</div>
        <div class="card-body">
            <form action="<?= $view['router']->path('password_recovery') ?>" method="post">
                <div class="form-group">
                    <input class="form-control" id="inputEmail" type="text" aria-describedby="emailHelp" placeholder="Enter email" name="_username">
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Submit request">
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="<?= $view['router']->path('login') ?>">Login</a>
            </div>
        </div>
    </div>
</div>