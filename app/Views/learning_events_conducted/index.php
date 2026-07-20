<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2 class="mb-3">Learning Events Conducted</h2>

<div class="mb-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addConductedModal">
        Add Record
    </button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div><?= esc($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<style>
.conducted-wrap{
    overflow-x:auto;
}

.conducted-table{
    width:100%;
    min-width:1900px;
    border-collapse:collapse;
    background:#fff;
}

.conducted-table th,
.conducted-table td{
    border:1px solid #222;
    padding:6px 6px;
    font-size:12px;
    vertical-align:top;
    word-break:break-word;
}

.conducted-table .main-title th{
    background:#234f96;
    color:#fff;
    font-size:16px;
    text-align:center;
    font-weight:700;
    letter-spacing:1px;
    padding:8px;
}

.conducted-table .header-1 th,
.conducted-table .header-2 th{
    background:#9db7e0;
    color:#000;
    text-align:center;
    vertical-align:middle;
    font-weight:700;
}

.conducted-table tbody td{
    background:#f6f6f6;
    line-height:1.3;
}

.conducted-table tbody tr:nth-child(even) td{
    background:#ededed;
}

.conducted-table td:nth-child(1){ min-width:40px; text-align:center; }
.conducted-table td:nth-child(2){ min-width:90px; }
.conducted-table td:nth-child(3){ min-width:90px; }
.conducted-table td:nth-child(4){ min-width:320px; }
.conducted-table td:nth-child(5){ min-width:80px; text-align:center; }
.conducted-table td:nth-child(6){ min-width:90px; text-align:center; }
.conducted-table td:nth-child(7){ min-width:90px; text-align:center; }
.conducted-table td:nth-child(8){ min-width:80px; text-align:center; }
.conducted-table td:nth-child(9){ min-width:90px; text-align:center; }
.conducted-table td:nth-child(10){ min-width:80px; text-align:center; }
.conducted-table td:nth-child(11){ min-width:80px; text-align:center; }
.conducted-table td:nth-child(12){ min-width:70px; text-align:center; background:#fff200; }
.conducted-table td:nth-child(13){ min-width:70px; text-align:center; }
.conducted-table td:nth-child(14){ min-width:120px; text-align:center; }
.conducted-table td:nth-child(15){ min-width:90px; text-align:center; }
.conducted-table td:nth-child(16){ min-width:100px; }
.conducted-table td:nth-child(17),
.conducted-table td:nth-child(18),
.conducted-table td:nth-child(19){ min-width:55px; text-align:center; background:#fff200; }
.conducted-table td:nth-child(20),
.conducted-table td:nth-child(21),
.conducted-table td:nth-child(22){ min-width:70px; text-align:center; }

.action-buttons{
    display:flex;
    flex-direction:column;
    gap:4px;
    margin-top:6px;
}

.action-buttons .btn{
    font-size:11px;
    padding:3px 6px;
}

/* MODAL HEIGHT FIX */
#addConductedModal .modal-dialog,
.modal[id^="editModal"] .modal-dialog {
    max-width:95%;
}

#addConductedModal .modal-content,
.modal[id^="editModal"] .modal-content {
    max-height:90vh;
}

#addConductedModal .modal-body,
.modal[id^="editModal"] .modal-body {
    overflow-y:auto;
    max-height:calc(90vh - 140px);
}
</style>

<div class="conducted-wrap">
    <table class="conducted-table">
        <thead>
            <tr class="main-title">
                <th colspan="23">2026 LEARNING EVENT CONDUCTED</th>
            </tr>

            <tr class="header-1">
                <th rowspan="2">No.</th>
                <th rowspan="2">RSO No.</th>
                <th rowspan="2">Special Order No.</th>
                <th rowspan="2">Learning Title</th>
                <th rowspan="2">Learning Service Provider</th>
                <th rowspan="2">Competency</th>
                <th rowspan="2">Type of Learning and Development</th>
                <th rowspan="2">Learning Administrator</th>
                <th rowspan="2">Office/Organization</th>
                <th colspan="2">Date</th>
                <th rowspan="2">Cost</th>
                <th rowspan="2">Training Hours</th>
                <th rowspan="2">Venue</th>
                <th rowspan="2">Sponsor</th>
                <th rowspan="2">Remarks (Participants)</th>
                <th colspan="3">No. of Participants</th>
                <th rowspan="2">Attendance Sheets</th>
                <th rowspan="2">Training Report Submission</th>
                <th rowspan="2">Evaluation</th>
                <th rowspan="2">Action</th>
            </tr>

            <tr class="header-2">
                <th>From</th>
                <th>To</th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $i => $e): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($e['rso_no'] ?? '') ?></td>
                        <td><?= esc($e['special_order_no'] ?? '') ?></td>
                        <td><?= esc($e['title'] ?? '') ?></td>
                        <td><?= esc($e['service_provider'] ?? '') ?></td>
                        <td><?= esc($e['competency'] ?? '') ?></td>
                        <td><?= esc($e['type_learning'] ?? '') ?></td>
                        <td><?= esc($e['learning_administrator'] ?? '') ?></td>
                        <td><?= esc($e['office_organization'] ?? '') ?></td>
                        <td><?= esc($e['date_from'] ?? '') ?></td>
                        <td><?= esc($e['date_to'] ?? '') ?></td>
                        <td><?= esc($e['cost'] ?? '') ?></td>
                        <td><?= esc($e['training_hours'] ?? '') ?></td>
                        <td><?= esc($e['venue'] ?? '') ?></td>
                        <td><?= esc($e['sponsor'] ?? '') ?></td>
                        <td><?= esc($e['remarks_participants'] ?? '') ?></td>
                        <td><?= esc($e['male'] ?? '') ?></td>
                        <td><?= esc($e['female'] ?? '') ?></td>
                        <td><?= esc($e['total'] ?? '') ?></td>
                        <td><?= esc($e['attendance_sheets'] ?? '') ?></td>
                        <td><?= esc($e['training_report_submission'] ?? '') ?></td>
                        <td><?= esc($e['evaluation'] ?? '') ?></td>
                        <td>
                            <div class="action-buttons">
                                <button type="button"
                                        class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal<?= esc($e['id']) ?>">
                                    Edit
                                </button>

                                <a href="/learning-events-conducted/delete/<?= esc($e['id']) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this record?')">
                                   Delete
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- EDIT MODAL -->
                    <div class="modal fade" id="editModal<?= esc($e['id']) ?>" tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <form method="post" action="/learning-events-conducted/update/<?= esc($e['id']) ?>">
                                    <?= csrf_field() ?>

                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title">Edit Learning Event Conducted</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">RSO No.</label>
                                                <input type="text" name="rso_no" value="<?= esc($e['rso_no'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Special Order No.</label>
                                                <input type="text" name="special_order_no" value="<?= esc($e['special_order_no'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Learning Service Provider</label>
                                                <input type="text" name="service_provider" value="<?= esc($e['service_provider'] ?? '') ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label">Learning Title</label>
                                            <textarea name="title" class="form-control" required><?= esc($e['title'] ?? '') ?></textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Competency</label>
                                                <input type="text" name="competency" value="<?= esc($e['competency'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Type of Learning and Development</label>
                                                <input type="text" name="type_learning" value="<?= esc($e['type_learning'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Learning Administrator</label>
                                                <input type="text" name="learning_administrator" value="<?= esc($e['learning_administrator'] ?? '') ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Office/Organization</label>
                                                <input type="text" name="office_organization" value="<?= esc($e['office_organization'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Date From</label>
                                                <input type="date" name="date_from" value="<?= esc($e['date_from'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Date To</label>
                                                <input type="date" name="date_to" value="<?= esc($e['date_to'] ?? '') ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Cost</label>
                                                <input type="number" step="0.01" name="cost" value="<?= esc($e['cost'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Training Hours</label>
                                                <input type="number" name="training_hours" value="<?= esc($e['training_hours'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Venue</label>
                                                <input type="text" name="venue" value="<?= esc($e['venue'] ?? '') ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Sponsor</label>
                                                <input type="text" name="sponsor" value="<?= esc($e['sponsor'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Male</label>
                                                <input type="number" name="male" value="<?= esc($e['male'] ?? '') ?>" class="form-control edit-male">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Female</label>
                                                <input type="number" name="female" value="<?= esc($e['female'] ?? '') ?>" class="form-control edit-female">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Total</label>
                                                <input type="number" name="total" value="<?= esc($e['total'] ?? '') ?>" class="form-control edit-total" readonly>
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Attendance Sheets</label>
                                                <input type="text" name="attendance_sheets" value="<?= esc($e['attendance_sheets'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Training Report Submission</label>
                                                <input type="text" name="training_report_submission" value="<?= esc($e['training_report_submission'] ?? '') ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label">Evaluation</label>
                                                <input type="text" name="evaluation" value="<?= esc($e['evaluation'] ?? '') ?>" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label class="form-label">Remarks (Participants)</label>
                                                <textarea name="remarks_participants" class="form-control"><?= esc($e['remarks_participants'] ?? '') ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="23" class="text-center text-muted">No records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->include('learning_events_conducted/create') ?>

<script>
const addMale = document.getElementById('add_male');
const addFemale = document.getElementById('add_female');
const addTotal = document.getElementById('add_total');

function computeAddTotal() {
    let m = parseInt(addMale.value) || 0;
    let f = parseInt(addFemale.value) || 0;
    addTotal.value = m + f;
}

if (addMale && addFemale && addTotal) {
    addMale.addEventListener('input', computeAddTotal);
    addFemale.addEventListener('input', computeAddTotal);
}

document.querySelectorAll('.modal').forEach(modal => {
    const male = modal.querySelector('.edit-male');
    const female = modal.querySelector('.edit-female');
    const total = modal.querySelector('.edit-total');

    if (male && female && total) {
        function computeEditTotal() {
            let m = parseInt(male.value) || 0;
            let f = parseInt(female.value) || 0;
            total.value = m + f;
        }

        male.addEventListener('input', computeEditTotal);
        female.addEventListener('input', computeEditTotal);
    }
});
</script>

<?= $this->endSection() ?>