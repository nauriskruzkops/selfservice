<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */
$view->extend('layout/base.html.php');

?><div class="container">
    <div class="row">
        <div class="card col-xs-12 col-sm-8 col-md-6 col-lg-4 mt-5" style="margin: auto auto">
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
</div>