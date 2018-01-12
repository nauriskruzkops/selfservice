<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \DatePeriod $calendar
 * @var \DateTime $calendarDay
 */

$view->extend('layout/blocks/card.html.php');

$data = [
    'startDate' => '2018-01-01',
    'employees' => [
        'Nauris' => [
            ['start'=>'2018-01-03','end'=>'2018-02-06']
        ],
        'Juris' => [
            ['start'=>'2018-01-03','end'=>'2018-02-06']
        ],
        'Jaanis' => [
            ['start'=>'2018-01-03','end'=>'2018-02-06']
        ],
    ],
]

?><div class="calendar_content row">

    <div class="timetable">
        <aside>
            <ul>
                <?php foreach ($data['employees'] as $employee=>$vocation):?>
                    <li>
                        <span class="row-heading"><?=$employee?></span>
                    </li>
                <?php endforeach;?>
            </ul>
        </aside>
        <section>
            <time>
                <header>
                    <ul>
                        <?php foreach ($calendar as $month):?>
                            <?php $daysPeriod = new \DatePeriod( clone $month->modify('first day of this month'), new \DateInterval('P1D'), clone $month->modify('last day of this month')); ?>
                            <?php foreach ($daysPeriod as $day):?>
                                <li class="day day-info day-name-<?= $day->format('N')?> <?= $day->format('N')>5?'weekend':''?>" data-date="<?= $day->format('Y-m-d')?>">
                                    <span class="time-label"><?= $day->format('d')?></span>
                                </li>
                            <?php endforeach;?>
                        <?php endforeach;?>
                    </ul>
                </header>
                <ul class="room-timeline">
                    <?php foreach ($data['employees'] as $employee=>$vocation):?>
                        <li>
                            <a href="#" class="time-entry"> </a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </time>
        </section>
    </div>

</div>

<script>
    (function() {
      //
    })();
    var timeTableData = JSON.parse('<?= json_encode($data)?>');
</script>