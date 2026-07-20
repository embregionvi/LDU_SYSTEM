    <?= $this->extend('layouts/main') ?>
    <?= $this->section('content') ?>

    <div class="mb-3 d-flex gap-2">
   <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#participantModal">
    <i class="fa-solid fa-user-plus"></i> Add Participant
</a>

        <a href="/trainings/export" class="btn btn-primary">
            <i class="fa-solid fa-file-excel"></i> Export Excel
        </a>
    </div>

    <style>
    .wrapper{
        overflow-x:auto;
    }

    .table-custom{
        width:100%;
        min-width:2500px;
        border-collapse:collapse;
        font-size:11px;
        background:#fff;
    }

    .table-custom th,
    .table-custom td{
        border:1px solid #000;
        padding:4px;
        vertical-align:top;
    }

    .title{
        background:#234f96;
        color:#fff;
        text-align:center;
        font-size:18px;
        font-weight:bold;
    }

    .header1{
        background:#9db7e0;
        text-align:center;
        font-weight:bold;
    }

    .header2{
        background:#c9d7ee;
        text-align:center;
        font-weight:bold;
    }

    tbody td{
        background:#f5f5f5;
    }

    tbody tr:nth-child(even) td{
        background:#ececec;
    }

    .table-custom td:nth-child(1){ min-width:45px; text-align:center; }
    .table-custom td:nth-child(2){ min-width:45px; text-align:center; }
    .table-custom td:nth-child(3){ min-width:120px; }
    .table-custom td:nth-child(4){ min-width:120px; }
    .table-custom td:nth-child(5){ min-width:120px; }
    .table-custom td:nth-child(6){ min-width:180px; }
    .table-custom td:nth-child(7){ min-width:45px; text-align:center; }
    .table-custom td:nth-child(8){ min-width:420px; }
    .table-custom td:nth-child(9){ min-width:120px; text-align:center; }
    .table-custom td:nth-child(10){ min-width:80px; text-align:center; }
    .table-custom td:nth-child(11){ min-width:90px; text-align:center; }
    .table-custom td:nth-child(12){ min-width:140px; text-align:center; }
    .table-custom td:nth-child(13){ min-width:160px; text-align:center; }
    .table-custom td:nth-child(14){ min-width:170px; text-align:center; }
    .table-custom td:nth-child(15){ min-width:150px; text-align:center; }
    .table-custom td:nth-child(16){ min-width:170px; text-align:center; }
    .table-custom td:nth-child(17){ min-width:140px; text-align:center; }
    .table-custom td:nth-child(18){ min-width:120px; text-align:center; }
    .table-custom td:nth-child(19){ min-width:120px; text-align:center; }
    </style>

    <div class="wrapper">
    <table class="table-custom">

<thead>
<tr class="title">
    <th colspan="19">2026 TRAINING DATABASE - CONTRACT OF SERVICE PERSONNEL</th>
</tr>

<tr class="header1">
    <th rowspan="2">SD</th>
    <th rowspan="2">No.</th>
    <th colspan="3">Names</th>
    <th rowspan="2">Position</th>
    <th rowspan="2">No.</th>
    <th rowspan="2">Title of Learning Event Intervention</th>
    <th colspan="3">Actual Date of Training</th>
    <th rowspan="2">Special Order No.</th>
    <th rowspan="2">Venue</th>
    <th rowspan="2">Conducted by</th>
    <th rowspan="2">Competency</th>
    <th rowspan="2">Individual Learning Report (Deadline)</th>
    <th rowspan="2">Date Received</th>
    <th rowspan="2">File</th>
    <th rowspan="2">Action</th>
</tr>

<tr class="header2">
    <th>Last</th>
    <th>First</th>
    <th>Middle</th>
    <th>Month</th>
    <th>Days</th>
    <th>Total Hours</th>
</tr>
</thead>

<tbody>
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $i => $r): ?>

<?php
$last   = $r['last_name'] ?? '';
$first  = $r['first_name'] ?? '';
$middle = $r['middle_name'] ?? '';
$month = !empty($r['date_from']) ? date('F', strtotime($r['date_from'])) : '';
$days = '';
if (!empty($r['date_from']) && !empty($r['date_to'])) {
    $fromDay = date('j', strtotime($r['date_from']));
    $toDay   = date('j', strtotime($r['date_to']));
    $days = ($fromDay === $toDay) ? $fromDay : $fromDay . '-' . $toDay;
}

$hours = $r['training_hours'] ?? '';
?>

<tr>
<td></td>
<td><?= $i + 1 ?></td>

<td><?= esc($last) ?></td>
<td><?= esc($first) ?></td>
<td><?= esc($middle) ?></td>

<td><?= esc($r['position']) ?></td>

<td><?= !empty($r['title']) ? 1 : '' ?></td>

<td><?= esc($r['title']) ?></td>
<td><?= esc($month) ?></td>
<td><?= esc($days) ?></td>
<td><?= esc($hours) ?></td>

<td><?= esc($r['special_order_no']) ?></td>
<td><?= esc($r['venue']) ?></td>
<td><?= esc($r['conducted_by']) ?></td>
<td><?= esc($r['competency']) ?></td>
<!-- ILR DEADLINE -->
<td><?= esc($r['ilr_deadline']) ?></td>

<!-- to add date received -->
<td>
    <?= !empty($r['date_received']) ? esc($r['date_received']) : '-' ?>
</td>
<td>
<?php if (!empty($r['file_path'])): ?>
    <a href="<?= base_url($r['file_path']) ?>" target="_blank" class="btn btn-sm btn-success">
        View File
    </a>
<?php endif; ?>
</td>

<td>
<button 
    class="btn btn-sm btn-warning open-modal"
    data-id="<?= $r['id'] ?>"
    data-name="<?= esc($last . ', ' . $first) ?>"
    data-title="<?= esc($r['title']) ?>"
    data-venue="<?= esc($r['venue']) ?>"
    data-date_from="<?= esc($r['date_from']) ?>"
    data-date_to="<?= esc($r['date_to']) ?>"
>
    Update
</button>
</td>

</tr>

<?php endforeach; ?>
<?php else: ?>
<tr>
<td colspan="18" class="text-center">No records found</td>
</tr>
<?php endif; ?>
</tbody>

</table>
    </div>

    <!-- ILR SUBMISSION MODAL -->
    <div class="modal fade" id="trainingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <form method="post" action="/trainings/save-ilr" enctype="multipart/form-data">

<div class="modal-header">
    <h5 class="modal-title">Individual Learning Report</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<input type="hidden" name="id" id="modal_id">

<div class="row">
    <div class="col-md-6 mb-2">
        <label>Date Submitted</label>
        <input type="date" name="date_submitted" class="form-control">
    </div>

    <div class="col-md-6 mb-2">
        <label>Date Received</label>
        <input type="date" name="date_received" class="form-control">
    </div>
</div>

<div class="mb-2">
    <label>Transaction Number</label>
    <input type="text" name="transaction_number" class="form-control">
</div>

<div class="mb-2">
    <label>Subject Name</label>
    <input type="text" name="subject_name" id="modal_title" class="form-control">
</div>

<div class="mb-2">
    <label>Name of Participant</label>
    <input type="text" name="participant_name" id="modal_name" class="form-control">
</div>

<div class="row">
    <div class="col-md-6 mb-2">
        <label>Date From</label>
        <input type="date" name="date_from" id="modal_date_from" class="form-control">
    </div>

    <div class="col-md-6 mb-2">
        <label>Date To</label>
        <input type="date" name="date_to" id="modal_date_to" class="form-control">
    </div>
</div>

<div class="mb-2">
    <label>Venue</label>
    <input type="text" name="venue" id="modal_venue" class="form-control">
</div>

<!-- FILE UPLOAD -->
<div class="mb-2">
    <label>Upload ILR File (PDF / Word)</label>
    <input type="file" name="ilr_file" class="form-control" accept=".pdf,.doc,.docx">
</div>

<div class="mb-2">
    <label>Recommendations / Remarks</label>
    <textarea name="remarks" class="form-control"></textarea>
</div>

</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-success">Save</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
</div>

</form>

    </div>
    </div>
    </div>
    <div class="modal fade" id="participantModal" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<form method="post" action="/participants/save">
<!--  add participant -->
<div class="modal-header">
    <h5 class="modal-title">Add Participant</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<div class="row">
    <div class="col-md-4 mb-2">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="col-md-4 mb-2">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="col-md-4 mb-2">
        <label>Middle Name</label>
        <input type="text" name="middle_name" class="form-control">
    </div>
</div>

<div class="mb-2">
    <label>Position</label>
    <input type="text" name="position" class="form-control">
</div>

<div class="mb-2">
    <label>Select Learning Event</label>
<select name="learning_event_id" id="eventSelect" class="form-control" required>
    <option value="">-- Select Training --</option>

    <?php foreach($learning_events as $e): ?>
    <option 
        value="<?= $e['id'] ?>"
        data-from="<?= $e['date_from'] ?>"
        data-to="<?= $e['date_to'] ?>"
        data-hours="<?= $e['training_hours'] ?>"
        data-venue="<?= esc($e['venue']) ?>"
        data-special="<?= esc($e['special_order_no']) ?>"
    >
        <?= esc($e['title']) ?>
    </option>
    <?php endforeach; ?>
</select>
</div>

<hr>

<div class="row">
    <div class="col-md-4 mb-2">
        <label>Month</label>
        <input type="text" id="month" class="form-control" readonly>
    </div>
    <div class="col-md-4 mb-2">
        <label>Days</label>
        <input type="text" id="days" class="form-control" readonly>
    </div>
    <div class="col-md-4 mb-2">
        <label>Total Hours</label>
        <input type="text" id="hours" class="form-control" readonly>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-2">
        <label>Special Order No.</label>
        <input type="text" id="special" class="form-control" readonly>
    </div>
    <div class="col-md-6 mb-2">
        <label>Venue</label>
        <input type="text" id="venue" class="form-control" readonly>
    </div>
</div>

<label>Conducted By</label>
<input type="text" name="conducted_by" class="form-control">

<label>Competency</label>
<input type="text" name="competency" class="form-control">

<div class="mb-2">
    <label>ILR Deadline (Auto +14 days)</label>
    <input type="date" name="ilr_deadline" id="deadline" class="form-control" readonly>
</div>
<input type="hidden" name="date_from" id="hidden_date_from">

</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-success">Save</button>
</div>

</form>

</div>
</div>
</div>

    
    <script>
document.querySelectorAll('.open-modal').forEach(button => {
    button.addEventListener('click', function () {

        document.getElementById('modal_id').value = this.dataset.id;

        document.getElementById('modal_name').value = this.dataset.name;
        document.getElementById('modal_title').value = this.dataset.title;
        document.getElementById('modal_venue').value = this.dataset.venue;
        document.getElementById('modal_date_from').value = this.dataset.date_from;
        document.getElementById('modal_date_to').value = this.dataset.date_to;

        let modal = new bootstrap.Modal(document.getElementById('trainingModal'));
        modal.show();
    });
});
    </script>
    <script>
document.getElementById('eventSelect').addEventListener('change', function(){

    let selected = this.options[this.selectedIndex];

    let from = selected.dataset.from;
    let to   = selected.dataset.to;

    if(!from) return;

    let fromDate = new Date(from);
    let toDate   = new Date(to);

    document.getElementById('month').value =
        fromDate.toLocaleString('default', { month: 'long' });

    let d1 = fromDate.getDate();
    let d2 = toDate.getDate();
    document.getElementById('days').value =
        (d1 === d2) ? d1 : d1 + '-' + d2;

    document.getElementById('hours').value = selected.dataset.hours;
    document.getElementById('venue').value = selected.dataset.venue;
    document.getElementById('special').value = selected.dataset.special;
    document.getElementById('hidden_date_from').value = from;

    // Deadline (+14 days)
    let deadline = new Date(fromDate);
    deadline.setDate(deadline.getDate() + 14);

    document.getElementById('deadline').value =
        deadline.toISOString().split('T')[0];
});
</script>

    <?= $this->endSection() ?> 