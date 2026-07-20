<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$eventRows = $events ?? [];
?>

<style>
.learning-events-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.table-container{
    background:#fff;
    border-radius:12px;
    padding:15px;
    overflow-x:auto;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

.table-title{
    background:#174a99;
    color:#fff;
    text-align:center;
    font-size:22px;
    font-weight:bold;
    padding:10px;
    min-width:1700px;
    text-transform:uppercase;
}

.learning-table{
    min-width:1700px;
    width:1700px;
    border-collapse:collapse;
    background:#fff;
}

.learning-table th,
.learning-table td{
    border:1px solid #000;
    padding:7px;
    font-size:13px;
    text-align:center;
    vertical-align:middle;
}

.learning-table th{
    background:#9bb6df;
    font-weight:bold;
}

.learning-table td.text-left{
    text-align:left;
}

.wrap{
    white-space:normal;
    word-break:break-word;
}

.nowrap{
    white-space:nowrap;
}

.btn-action{
    width:75px;
    margin-bottom:5px;
}
</style>

<div class="learning-events-header">
    <h2>Learning Events</h2>

    <a href="<?= base_url('/learning-events/create') ?>" class="btn btn-success">
        + Add Learning Event
    </a>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="table-container">

    <div class="table-title">
        2026 Learning Events Attended
    </div>

    <table class="learning-table">

        <thead>
            <tr>
                <th rowspan="2">IIS No.</th>
                <th rowspan="2">Special<br>Order<br>No.</th>
                <th rowspan="2">Learning Title</th>
                <th rowspan="2">Learning<br>Service<br>Provider</th>
                <th rowspan="2">Type of<br>Learning and<br>Development</th>
                <th rowspan="2">Office /<br>Agency</th>
                <th colspan="2">Date</th>
                <th rowspan="2">Cost<br>(Registration)</th>
                <th rowspan="2">Training<br>Hours</th>
                <th rowspan="2">Venue</th>
                <th rowspan="2">Sponsor</th>
                <th rowspan="2">Remarks<br>(Participants)</th>
                <th colspan="3">No. of Participants</th>
                <th rowspan="2">Traveling Expense<br>(Airfare/Per<br>Diems/Other)</th>
                <th rowspan="2">Actions</th>
            </tr>

            <tr>
                <th>From</th>
                <th>To</th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

        <?php if(!empty($eventRows)): ?>

            <?php foreach($eventRows as $event): ?>

                <?php
                $id               = $event['id'] ?? '';
                $iis_no           = $event['iis_no'] ?? '';
                $special_order_no = $event['special_order_no'] ?? '';
                $title            = $event['title'] ?? '';
                $provider         = $event['provider'] ?? '';
                $type_learning    = $event['type_learning'] ?? '';
                $office           = $event['office'] ?? '';
                $date_from        = $event['date_from'] ?? '';
                $date_to          = $event['date_to'] ?? '';
                $cost             = $event['cost'] ?? '';
                $training_hours   = $event['training_hours'] ?? '';
                $venue            = $event['venue'] ?? '';
                $sponsor          = $event['sponsor'] ?? '';
                $remarks          = $event['remarks'] ?? '';
                $male             = $event['male'] ?? '';
                $female           = $event['female'] ?? '';
                $total            = $event['total'] ?? '';
                $travel_expense   = $event['travel_expense'] ?? '';
                ?>

                <tr>

                    <td><?= esc($iis_no) ?></td>

                    <td class="wrap">
                        <?= esc($special_order_no) ?>
                    </td>

                    <td class="text-left wrap" style="min-width:280px;">
                        <?= esc($title) ?>
                    </td>

                    <td class="wrap">
                        <?= esc($provider) ?>
                    </td>

                    <td class="wrap">
                        <?= esc($type_learning) ?>
                    </td>

                    <td class="wrap">
                        <?= esc($office) ?>
                    </td>

                    <td class="nowrap">
                        <?= esc($date_from) ?>
                    </td>

                    <td class="nowrap">
                        <?= esc($date_to) ?>
                    </td>

                    <td class="nowrap">
                        <?= esc($cost) ?>
                    </td>

                    <td class="nowrap">
                        <?= esc($training_hours) ?>
                    </td>

                    <td class="wrap">
                        <?= esc($venue) ?>
                    </td>

                    <td class="wrap">
                        <?= esc($sponsor) ?>
                    </td>

                    <td class="text-left wrap" style="min-width:220px;">
                        <?= esc($remarks) ?>
                    </td>

                    <td><?= esc($male) ?></td>

                    <td><?= esc($female) ?></td>

                    <td><?= esc($total) ?></td>

                    <td class="wrap">
                        <?= esc($travel_expense) ?>
                    </td>

                    <td>

                        <a href="<?= base_url('/learning-events/edit/' . $id) ?>"
                           class="btn btn-sm btn-warning btn-action">
                            Edit
                        </a>

                        <form action="<?= base_url('/learning-events/delete/' . $id) ?>"
                              method="post"
                              onsubmit="return confirm('Delete this event?');">

                            <?= csrf_field() ?>

                            <button type="submit"
                                    class="btn btn-sm btn-danger btn-action">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="18" class="text-center">
                    No learning events found.
                </td>
            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>

<?= $this->endSection() ?>