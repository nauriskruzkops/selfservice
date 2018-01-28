<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \DatePeriod $calendar
 * @var \DateTime $calendarDay
 * @var \DateTime $startDate
 * @var \App\Entity\CompanyEmployee[] $employees
 * @var \App\Entity\Vocation $vocation
 */

$view->extend('layout/blocks/div.html.php');

$daysFromPeriodStart = function (\DateTime $vocationStartDate) use ($startDate) {
    $days = $startDate->diff($vocationStartDate)->days;
    return $days === 1 ? 0 : $days;
};

$styleLeft = function ($vocationStartDate) use ($daysFromPeriodStart) {
    $days = $daysFromPeriodStart($vocationStartDate);
        $days++;
    return $days * 30;
};

?><div class="calendar_content">
    <div class="timetable">
        <ul class="timeline-employees">
            <?php foreach ($employees as $employee):?>
                <li>
                    <span class="row-heading">
                        <?=$employee->getEmployee()->getFullName()?>
                    </span>
                    <span class="pull-right" style="font-size: 80%">
                        <a href="#" data-url="<?php echo $view['router']->path('vocation_add',['employee' => $employee->getEmployee()->getId()]) ?>" data-toggle="modal" data-target="#globalAjaxModal">
                            <i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a>
                    </span>
                </li>
            <?php endforeach;?>
        </ul>
        <section>
            <time>
                <div class="timeline-header">
                    <ul>
                        <?php foreach ($calendar as $month):?>
                            <?php $daysPeriod = new \DatePeriod( clone $month->modify('first day of this month'), new \DateInterval('P1D'), clone $month->modify('last day of this month')); ?>
                            <?php foreach ($daysPeriod as $day):?>
                                <li class="day day-info day-name-<?= $day->format('N')?> <?= $day->format('N')>5?'weekend':''?>" data-date="<?= $day->format('Y-m-d')?>">
                                    <span class="day-label"><?= $day->format('d')?></span>
                                </li>
                            <?php endforeach;?>
                        <?php endforeach;?>
                    </ul>
                </div>
                <ul class="timeline-vocation">
                    <?php foreach ($employees as $employee):?>
                        <li>
                            <?php foreach ($employee->getEmployee()->getVocations() as $vocation): ?>
                                <a href="#" data-url="<?php echo $view['router']->path('vocation_info',['id' => $vocation->getId()]) ?>" class="time-entry" data-toggle="modal" data-target="#globalAjaxModal" <?php
                                ?> style="width: <?=$vocation->getDays()*30 ?>px; left: <?=$styleLeft($vocation->getStartDate()) ?>px"<?php
                                ?> data-days="<?= $vocation->getDays()?>"> </a>
                            <?php endforeach;?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </time>
        </section>
    </div>
</div>