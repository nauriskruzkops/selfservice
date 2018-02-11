<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */
$view->extend('layout/base.html.php');

?><div class="container">
    <?= $view->render('layout/partial/flash-messages.html.php')?>
    <div class="card card-login mx-auto mt-5">
        <div class="card-body">
            <h2>Login</h2>
            <p></p>
            <form action="<?= $view['router']->path('login') ?>" method="post">
                <div class="form-group">
                    <input class="form-control" id="inputEmail" type="text" aria-describedby="emailHelp" placeholder="Enter email" name="_username" value="<?= $last_username ?? ''?>">
                </div>
                <div class="form-group">
                    <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="_password">
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="<?= $view['router']->path('register') ?>">Register an Account</a>
                <a class="d-block small" href="<?= $view['router']->path('password_recovery') ?>">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>