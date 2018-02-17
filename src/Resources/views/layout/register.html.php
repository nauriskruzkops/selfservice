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
                <h2>Register</h2>
                <p>Enter your email address and we will send you instructions how can you get in.</p>
                <form action="<?= $view['router']->path('register') ?>" method="post">
                    <div class="form-group">
                        <input class="form-control" id="inputEmail" type="text" placeholder="Enter email" name="_useremail">
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