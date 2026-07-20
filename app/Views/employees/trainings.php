<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.history-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.info-card,
.history-card{
    border:0;
    border-radius:14px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
    overflow:hidden;
    margin-bottom:25px;
}

.card-title-bar{
    background:#0d6efd;
    color:#fff;
    padding:14px 20px;
    font-weight:600;
    font-size:18px;
}

.card-title-bar.green{
    background:#198754;
}

.card-title-bar.blue{
    background:#0dcaf0;
}

.employee-info{
    padding:22px;
}

.info-label{
    font-size:13px;
    color:#6b7280;
    font-weight:700;
    text-transform:uppercase;
}

.info-value{
    font-size:16px;
    font-weight:600;
    color:#111827;
}

.stat-box{
    background:#ffffff;
    border-radius:12px;
    padding:18px;
    box-shadow:0 3px 12px rgba(0,0,0,0.06);
    text-align:center;
    margin-bottom:20px;
}

.stat-number{
    font-size:30px;
    font-weight:800;
    color:#0d6efd;
}

.stat-label{
    color:#6b7280;
    font-weight:600;
}

.empty-state{
    text-align:center;
    padding:35px;
    color:#6b7280;
}

.empty-state i{
    font-size:38px;
    margin-bottom:10px;
    color:#9ca3af;
}

.table th{
    background:#f8fafc;
    font-weight:700;
}

.table td{
    vertical-align:middle;
}
</style>

<div class="history-header">
    <div>
        <h2 class="mb-1">Employee Learning History</h2>
        <p class="text-muted mb-0">Training and event records of this employee</p>
    </div>

    <a href="/employees" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Back to Employees
    </a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="stat-box">
            <div class="stat-number"><?= count($trainings ?? []) ?></div>
            <div class="stat-label">Total Trainings</div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="stat-box">
            <div class="stat-number"><?= count($events ?? []) ?></div>
            <div class="stat-label">Events Attended</div>
        </div>
    </div>
</div>

<div class="card info-card">
    <div class="card-title-bar">
        <i class="fa fa-user"></i> Employee Information
    </div>

    <div class="employee-info">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="info-label">Employee Code</div>
                <div class="info-value"><?= esc($employee['employee_code']) ?></div>
            </div>

            <div class="col-md-3">
                <div class="info-label">Name</div>
                <div class="info-value"><?= esc($employee['name']) ?></div>
            </div>

            <div class="col-md-4">
                <div class="info-label">Position</div>
                <div class="info-value"><?= esc($employee['position']) ?></div>
            </div>

            <div class="col-md-2">
                <div class="info-label">Type</div>
                <?php if ($employee['employment_type'] === 'Permanent'): ?>
                    <span class="badge bg-success fs-6">Permanent</span>
                <?php else: ?>
                    <span class="badge bg-secondary fs-6">COS</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="card history-card">
    <div class="card-title-bar green d-flex justify-content-between align-items-center">
        <span><i class="fa fa-graduation-cap"></i> Trainings</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date From</th>
                    <th>Date To</th>
                    <th>Venue</th>
                    <th>Competency</th>
                    <th>LDU Budget</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($trainings)): ?>
                    <?php foreach ($trainings as $training): ?>
                        <tr>
                            <td class="fw-semibold"><?= esc($training['title'] ?? '') ?></td>
                            <td><?= esc($training['date_from'] ?? '') ?></td>
                            <td><?= esc($training['date_to'] ?? '') ?></td>
                            <td><?= esc($training['venue'] ?? '') ?></td>
                            <td><?= esc($training['competency'] ?? '') ?></td>
                            <td><?= esc($training['ldu_budget'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa fa-folder-open"></i>
                                <h5>No training records yet</h5>
                                <p class="mb-0">This employee has no training history recorded.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card history-card">
    <div class="card-title-bar blue d-flex justify-content-between align-items-center">
        <span><i class="fa fa-calendar-check"></i> Events Attended</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Event Date</th>
                    <th>IIS No.</th>
                    <th>Special Order No.</th>
                    <th>Title</th>
                    <th>Conducted By</th>
                    <th>Venue</th>
                    <th>Remarks</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= esc($event['event_date'] ?? '') ?></td>
                            <td><?= esc($event['iis_no'] ?? '') ?></td>
                            <td><?= esc($event['special_order_no'] ?? '') ?></td>
                            <td class="fw-semibold"><?= esc($event['title'] ?? '') ?></td>
                            <td><?= esc($event['conducted_by'] ?? '') ?></td>
                            <td><?= esc($event['venue'] ?? '') ?></td>
                            <td><?= esc($event['remarks'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fa fa-calendar-xmark"></i>
                                <h5>No attended events yet</h5>
                                <p class="mb-0">This employee has no attended events recorded.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>