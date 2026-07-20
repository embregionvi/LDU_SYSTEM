<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Employee Training Summary</h2>

<h4><?= esc($employee['name']) ?></h4>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="card p-3">
            <strong>Total Trainings</strong>
            <h4><?= $totalTrainings ?></h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <strong>Total Budget</strong>
            <h4>₱<?= number_format($totalBudget,2) ?></h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <strong>Total CPD Units</strong>
            <h4><?= $totalCPD ?></h4>
        </div>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Competency</th>
            <th>CPD</th>
            <th>Budget</th>
        </tr>
    </thead>
    <tbody>
        <?php if(empty($trainings)): ?>
            <tr>
                <td colspan="6" class="text-center">No trainings found</td>
            </tr>
        <?php endif; ?>

        <?php foreach($trainings as $t): ?>
        <tr>
            <td><?= esc($t['title']) ?></td>
            <td><?= esc($t['date_from']) ?></td>
            <td><?= esc($t['venue']) ?></td>
            <td><?= esc($t['competency']) ?></td>
            <td><?= esc($t['cpd_units']) ?></td>
            <td>₱<?= number_format((float)$t['ldu_budget'],2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>