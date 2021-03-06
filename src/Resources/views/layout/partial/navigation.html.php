<?php

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 */

$menu = [
    'root' => [
        'icon' => 'fa fa-fw fa-dashboard',
        'title' => 'Overview',
        'route' => [
            'key' => 'root',
            'params' => []
        ],
        'matching' => [''],
        'matching_regex' => '/ /',
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
    ]
];

if ($this->get('security')->isGranted(User::ROLE_MANAGER)) {
    $menu['department']= [
        'icon' => 'fa fa-fw fa-users',
        'title' => 'Department',
        'route' => [
            'key' => 'department',
            'params' => []
        ],
        'matching' => ['department'],
        'matching_regex' => '/department_*/',
    ];
}

if ($this->get('security')->isGranted(User::ROLE_ADMIN)) {
    $menu['system']= [
        'icon' => 'fa fa-fw fa-cogs',
        'title' => 'System',
        'route' => [
            'key' => 'system',
            'params' => []
        ],
        'matching' => ['system'],
        'matching_regex' => '/system_*/',
    ];
}

$parentRequest = $request;

$check_active_menu = function ($item) use ($menu, $parentRequest) {
    if ($menu[$item] ?? false) {
        if (in_array($parentRequest->attributes->get('_route'), $menu[$item]['matching'])) {
            return 'active';
        } elseif (isset($menu[$item]['matching_regex'])) {
            if (preg_match($menu[$item]['matching_regex'], $parentRequest->attributes->get('_route'))){
                return 'active';
            }
        }

    }
};

?>
<div>
    <ul id="sidebarNav" class="navbar-nav navbar-sidenav navbar-dark">
        <?php foreach ($menu as $menuKey => $menuItem) :?>
            <li class="nav-item <?= $check_active_menu($menuKey)?>" data-toggle="tooltip" data-placement="right" title="<?= $menuItem['title']?>">
                <a class="nav-link" href="<?= $view['router']->path($menuItem['route']['key'],$menuItem['route']['params']) ?>">
                    <i class="<?= $menuItem['icon']?>"></i>
                    <span class="nav-link-text"><?= $menuItem['title']?></span>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
</div>
