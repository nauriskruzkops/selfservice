<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \DatePeriod $calendar
 * @var \DateTime $calendarDay
 * @var \DateTime $startDate
 * @var \App\Entity\CompanyEmployee[] $employees
 * @var \App\Entity\Vacation $vacation
 */

$view->extend('layout/blocks/div.html.php');

$today = new \DateTime();
$currentMonth = clone $today->modify('first day of this month');

$daysFromPeriodStart = function (\DateTime $vacationStartDate) use ($startDate) {
    $days = $startDate->diff($vacationStartDate)->days;
    return $days === 1 ? 0 : $days;
};

$styleLeft = function ($vacationStartDate) use ($daysFromPeriodStart) {
    $days = $daysFromPeriodStart($vacationStartDate);
        $days++;
    return $days * 30;
};

?><div class="calendar_content">
    <div class="timetable">
        <ul class="timeline-employees" style="padding-top: 20px !important;">
            <?php foreach ($employees ?? [] as $employee) : ?>
                <?php $currentUser = ($employee->getEmployee() == $app->getUser()->getEmployee()); ?>
                <li>
                    <span class="row-heading">
                        <span class="bg-dark small" style="padding: 0 3px; margin-right: 3px">
                            <?=$employee->getEmployee()->getShortTitle()?>
                        </span>
                        <span class="<?= ($currentUser)?'font-weight-bold':''?>">
                            <?= $this->escape($employee->getEmployee()->getName())?>
                        </span>
                    </span>
                    <?php /** @todo : refactor */ if($app->getUser()->isUser()) :?>
                        <?php if($currentUser) :?>
                            <span class="pull-right" style="font-size: 80%">
                                <strong><a class="font-weight-bold" href="<?php echo $view['router']->path('employee_vacation_add',[
                                        'employee_id' => $employee->getEmployee()->getId()
                                ]) ?>" data-toggle="modal" data-target="#globalAjaxModal">
                                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a></strong>
                            </span>
                        <?php endif;?>
                    <?php else :?>
                        <span class="pull-right" style="font-size: 80%">
                            <a href="<?php echo $view['router']->path('employee_vacation_add',[
                                'employee_id' => $employee->getEmployee()->getId()
                            ]) ?>" data-toggle="modal" data-target="#globalAjaxModal">
                                <i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a>
                        </span>
                    <? endif;?>
                </li>
            <?php endforeach;?>
        </ul>
        <section style="padding-top: 20px !important;">
            <time>
                <div class="timeline-header">
                    <ul>
                        <?php foreach ($calendar as $month):?>
                            <?php $daysPeriod = new \DatePeriod( clone $month->modify('first day of this month'), new \DateInterval('P1D'), clone $month->modify('last day of this month')); ?>
                            <?php foreach ($daysPeriod as $day) :?>
                                <?php
                                    $thisMonth = ($today->format('m') == $day->format('m'));
                                    $newMonth = ((int)$day->format('d') === 1);
                                ?>
                                <li data-month="<?= $day->format('Ym')?>" class="day day-info day-name-<?= $day->format('N')?> <?= $day->format('N')>5?'weekend':''?>" data-date="<?= $day->format('Y-m-d')?>">
                                    <span class="day-label <?= ($newMonth)?'font-weight-bold':''?>">
                                        <?= $day->format('d')?>
                                    </span>
                                    <?php if ($newMonth) :?>
                                        <div class="text-dark new-month <?=$thisMonth ? 'current-month':'' ?>" style="margin: -20px 0 0 -15px; display: inline; position: absolute; z-index: 10; font-size: 200%; color: #e2e2e2">
                                            <strong><?= $day->format('F')?></strong>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach;?>
                        <?php endforeach;?>
                    </ul>
                </div>
                <ul class="timeline-vacation">
                    <?php foreach ($employees ?? [] as $employee):?>
                        <li>
                            <?php foreach ($employee->getEmployee()->getVacations() as $vacation): ?>
                                <a href="<?php echo $view['router']->path('employee_vacation_info',[
                                        'employee_id' => $employee->getEmployee()->getId(),
                                        'vacation_id' => $vacation->getId(),
                                ]) ?>" class="time-entry" data-toggle="modal" data-target="#globalAjaxModal" <?php
                                ?> style="width: <?=$vacation->getDays()*30 ?>px; left: <?=$styleLeft($vacation->getStartDate()) ?>px"<?php
                                ?> data-days="<?= $vacation->getDays()?>"> </a>
                            <?php endforeach;?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </time>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $(".calendar_content section").scrollLeft(Math.round($('.timeline-header .current-month').offset().left));
    });
</script>