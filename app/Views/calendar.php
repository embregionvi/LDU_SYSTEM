<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$firstDayOfMonth = strtotime($selectedYear . '-' . $selectedMonth . '-01');
$daysInMonth = date('t', $firstDayOfMonth);
$startDay = date('w', $firstDayOfMonth);
?>

<h3 class="mb-3">Calendar</h3>

<div class="card">
    <div class="card-header bg-primary text-white">
        <?= date('F Y', $firstDayOfMonth) ?>
    </div>

    <div class="card-body p-0">

        <div style="display:grid;grid-template-columns:repeat(7,1fr);">

            <?php foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d): ?>
                <div style="padding:10px;border:1px solid #ddd;font-weight:bold;text-align:center;">
                    <?= $d ?>
                </div>
            <?php endforeach; ?>

            <?php for($i=0;$i<$startDay;$i++): ?>
                <div style="border:1px solid #ddd;height:100px;"></div>
            <?php endfor; ?>

            <?php for($day=1;$day<=$daysInMonth;$day++): ?>
                <?php
                $dateKey = $selectedYear.'-'.str_pad($selectedMonth,2,'0',STR_PAD_LEFT).'-'.str_pad($day,2,'0',STR_PAD_LEFT);
                ?>
                <div style="border:1px solid #ddd;height:100px;padding:5px;">
                    <strong><?= $day ?></strong>

                    <?php if(!empty($eventsByDate[$dateKey])): ?>
                        <?php foreach($eventsByDate[$dateKey] as $e): ?>
                            <div style="font-size:11px;background:#e3f2fd;margin-top:3px;padding:2px;border-radius:3px;">
                                <?= esc($e['title']) ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            <?php endfor; ?>

        </div>

    </div>
</div>

<?= $this->endSection() ?>