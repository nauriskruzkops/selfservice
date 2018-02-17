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
                <h2>Forgot your password?</h2>
                <p>Enter your email address and we will send you instructions on how to reset your password.</p>
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
</div>