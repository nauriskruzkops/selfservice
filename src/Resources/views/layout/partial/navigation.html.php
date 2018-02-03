<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */

$menu = [
    'dashboard' => [
        'icon' => 'fa fa-fw fa-dashboard',
        'title' => 'Dashboard',
        'route' => [
            'key' => 'dashboard',
            'params' => []
        ],
        'matching' => ['dashboard'],
    ],
    'calendar' => [
        'icon' => 'fa fa-fw fa-calendar',
        'title' => 'Calendar',
        'route' => [
            'key' => 'calendar',
            'params' => []
        ],
        'matching' => ['calendar'],
    ],
    'employees' => [
        'icon' => 'fa fa-fw fa-users',
        'title' => 'Employees',
        'route' => [
            'key' => 'employees',
            'params' => []
        ],
        'matching' => ['employees'],
    ],
    'system' => [
        'icon' => 'fa fa-fw fa-cogs',
        'title' => 'System',
        'route' => [
            'key' => 'system',
            'params' => []
        ],
        'matching' => ['system'],
        'matching_regex' => '/system_/',
    ],
];

$parentRequest = $_parent;

$check_active_menu = function ($item) use ($menu, $parentRequest) {
    if ($menu[$item] ?? false) {
        if (in_array($parentRequest->attributes->get('_route'), $menu[$item]['matching'])) {
            return 'active';
        } elseif (isset($menu[$item]['matching_regex']) and preg_match($menu[$item]['matching_regex'], $parentRequest->attributes->get('_route'))) {
            return 'active';
        }

    }
};

?><div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <?php foreach ($menu as $menuKey => $menuItem) :?>
            <li class="nav-item <?= $check_active_menu($menuKey)?>" data-toggle="tooltip" data-placement="right" title="<?= $menuItem['title']?>">
                <a class="nav-link" href="<?php echo $view['router']->path($menuItem['route']['key'],$menuItem['route']['params']) ?>">
                    <i class="<?= $menuItem['icon']?>"></i>
                    <span class="nav-link-text"><?= $menuItem['title']?></span>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
    <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
                <i class="fa fa-fw fa-angle-left"></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
    </ul>
</div>