<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$activeTab = $_GET['tab'] ?? 'home';

$firstDayOfMonth = strtotime($selectedYear . '-' . str_pad($selectedMonth, 2, '0', STR_PAD_LEFT) . '-01');
$daysInMonth = (int) date('t', $firstDayOfMonth);
$startDayOfWeek = (int) date('w', $firstDayOfMonth);

$prevMonth = $selectedMonth - 1;
$prevYear = $selectedYear;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $selectedMonth + 1;
$nextYear = $selectedYear;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}
?>

<style>
.gov-topbar{
    background:#ffffff;
    border-left:6px solid #0b3d91;
    border-radius:18px;
    padding:22px 26px;
    margin-bottom:24px;
    box-shadow:0 6px 20px rgba(0,0,0,0.08);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
}

.gov-agency{
    font-size:13px;
    font-weight:700;
    color:#0b3d91;
    text-transform:uppercase;
    letter-spacing:.8px;
    margin-bottom:4px;
}

.dashboard-title{
    font-size:28px;
    font-weight:800;
    color:#1f2937;
    margin:0;
}

.gov-date{
    background:#f1f5f9;
    color:#0b3d91;
    padding:10px 16px;
    border-radius:999px;
    font-weight:700;
    font-size:14px;
    white-space:nowrap;
}


.dashboard-tabs-wrap{
    background:#fff;
    border-radius:16px;
    padding:10px;
    box-shadow:0 4px 14px rgba(0,0,0,0.06);
    margin-bottom:24px;
}

.dashboard-tab{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 16px;
    border-radius:12px;
    text-decoration:none;
    color:#495057;
    font-weight:600;
    transition:.2s ease;
    border:none;
    background:transparent;
}

.dashboard-tab:hover{
    background:#f1f5f9;
    color:#0b3d91;
}

.dashboard-tab.active{
    background:#0b3d91;
    color:#fff;
}

.dashboard-panel{
    display:none;
}

.dashboard-panel.active{
    display:block;
}

.stat-card{
    border:0;
    border-radius:18px;
    box-shadow:0 4px 16px rgba(0,0,0,0.07);
    overflow:hidden;
    height:100%;
}

.stat-card .card-body{
    padding:22px;
}

.stat-label{
    font-size:13px;
    color:#6c757d;
    margin-bottom:8px;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:.4px;
}

.stat-value{
    font-size:30px;
    font-weight:800;
    margin:0;
    line-height:1;
}

.stat-icon{
    width:54px;
    height:54px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}

.bg-soft-blue{ background:#e8f1ff; color:#0b5ed7; }
.bg-soft-green{ background:#e9f7ef; color:#198754; }
.bg-soft-orange{ background:#fff3e6; color:#fd7e14; }
.bg-soft-purple{ background:#f1e8ff; color:#6f42c1; }
.bg-soft-red{ background:#fdeaea; color:#dc3545; }
.bg-soft-dark{ background:#edf2f7; color:#343a40; }

.section-card{
    border:0;
    border-radius:18px;
    box-shadow:0 4px 16px rgba(0,0,0,0.07);
    overflow:hidden;
    margin-bottom:24px;
}

.section-card .card-header{
    border:0;
    padding:16px 20px;
    font-weight:700;
}

.training-header{
    background:linear-gradient(90deg,#198754,#157347);
    color:#fff;
}

.event-header{
    background:linear-gradient(90deg,#0d6efd,#0b5ed7);
    color:#fff;
}

.learning-header{
    background:linear-gradient(90deg,#6f42c1,#5a32a3);
    color:#fff;
}

.document-header{
    background:linear-gradient(90deg,#343a40,#212529);
    color:#fff;
}

.message-header{
    background:linear-gradient(90deg,#17a2b8,#138496);
    color:#fff;
}

.calendar-header{
    background:linear-gradient(90deg,#0b3d91,#1456c1);
    color:#fff;
    padding:16px 20px;
}

.filter-card{
    border:0;
    border-radius:18px;
    box-shadow:0 4px 16px rgba(0,0,0,0.07);
    margin-bottom:24px;
}

.filter-card .card-body{
    padding:18px;
}

.table-modern{
    margin-bottom:0;
}

.table-modern thead th{
    background:#f8fafc;
    border-bottom:1px solid #e9ecef;
    color:#495057;
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:.3px;
    vertical-align:middle;
}

.table-modern td{
    vertical-align:middle;
    font-size:14px;
    padding-top:14px;
    padding-bottom:14px;
}

.title-text-blue{
    color:#0d6efd;
    font-weight:700;
}

.title-text-green{
    color:#198754;
    font-weight:700;
}

.title-text-purple{
    color:#6f42c1;
    font-weight:700;
}

.title-text-dark{
    color:#212529;
    font-weight:700;
}

.soft-badge{
    display:inline-block;
    padding:5px 10px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}

.badge-blue{
    background:#e7f1ff;
    color:#0a58ca;
}

.badge-green{
    background:#d1e7dd;
    color:#0f5132;
}

.badge-purple{
    background:#efe7ff;
    color:#5a32a3;
}

.badge-gray{
    background:#f1f3f5;
    color:#495057;
}

.badge-red{
    background:#fdeaea;
    color:#b02a37;
}

.empty-state{
    padding:24px !important;
    text-align:center;
    color:#6c757d;
}

.quick-card{
    border:0;
    border-radius:18px;
    box-shadow:0 4px 16px rgba(0,0,0,0.07);
    margin-bottom:24px;
}

.quick-link{
    display:flex;
    align-items:center;
    gap:12px;
    text-decoration:none;
    padding:12px 14px;
    border-radius:12px;
    color:#212529;
    margin-bottom:10px;
    background:#f8f9fa;
    font-weight:600;
    transition:.2s ease;
}

.quick-link:hover{
    background:#e9ecef;
    color:#0b3d91;
}

.info-box{
    border:0;
    border-radius:18px;
    box-shadow:0 4px 16px rgba(0,0,0,0.07);
}

.calendar-grid{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    border-left:1px solid #dee2e6;
    border-top:1px solid #dee2e6;
    background:#fff;
}

.calendar-day-name{
    background:#f8f9fa;
    font-weight:700;
    text-align:center;
    padding:12px 8px;
    border-right:1px solid #dee2e6;
    border-bottom:1px solid #dee2e6;
    font-size:13px;
}

.calendar-cell{
    min-height:140px;
    padding:8px;
    border-right:1px solid #dee2e6;
    border-bottom:1px solid #dee2e6;
    background:#fff;
    cursor:pointer;
    transition:.15s ease;
}

.calendar-cell:hover{
    background:#f8fbff;
}

.calendar-cell.empty{
    background:#f8f9fa;
    cursor:default;
}

.calendar-date{
    font-weight:700;
    margin-bottom:8px;
    color:#212529;
}

.calendar-event{
    background:#e8f1ff;
    border-left:4px solid #0b3d91;
    border-radius:8px;
    padding:6px 8px;
    font-size:12px;
    margin-bottom:6px;
}

.calendar-event-link{
    text-decoration:none;
    color:inherit;
    display:block;
}

.calendar-event-title{
    font-weight:700;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.calendar-event-venue{
    font-size:11px;
    color:#6c757d;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.today-cell{
    background:#fffbea;
    border:2px solid #ffc107;
}

.calendar-legend{
    display:flex;
    gap:14px;
    flex-wrap:wrap;
    margin-bottom:14px;
}

.legend-item{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:13px;
    color:#495057;
}

.legend-color{
    width:14px;
    height:14px;
    border-radius:4px;
    display:inline-block;
}

/* NOTIFICATION BELL */
.notif-wrap{
    position:relative;
}

.notif-btn{
    position:relative;
    min-width:48px;
    justify-content:center;
}

.notif-badge{
    position:absolute;
    top:4px;
    right:4px;
    min-width:18px;
    height:18px;
    padding:0 5px;
    border-radius:999px;
    background:#dc3545;
    color:#fff;
    font-size:11px;
    font-weight:700;
    display:none;
    align-items:center;
    justify-content:center;
    line-height:18px;
}

.notif-menu{
    width:350px;
    max-height:420px;
    overflow-y:auto;
    border:none;
    border-radius:14px;
    box-shadow:0 12px 30px rgba(0,0,0,0.12);
}

.notif-header{
    padding:12px 14px;
    border-bottom:1px solid #e9ecef;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.notif-item{
    display:block;
    padding:12px 14px;
    text-decoration:none;
    color:#212529;
    border-bottom:1px solid #f1f3f5;
}

.notif-item:hover{
    background:#f8f9fa;
    color:#0b3d91;
}

.notif-item-title{
    font-weight:700;
    margin-bottom:4px;
}

.notif-item-text{
    font-size:13px;
    color:#495057;
}

.notif-item-time{
    font-size:12px;
    color:#6c757d;
}

@media (max-width: 768px){

    .dashboard-title{
        font-size:22px;
    }

    .stat-value{
        font-size:24px;
    }

    .calendar-cell{
        min-height:100px;
    }

    .notif-menu{
        width:300px;
    }

}

/* ===== COLORED DASHBOARD CARDS ===== */

.stat-card-colored {
    border: none;
    border-radius: 18px;
    color: #fff;
    padding: 22px;
    min-height: 135px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
}

.stat-card-colored .stat-icon {
    width: 55px;
    height: 55px;
    border-radius: 15px;
    background: rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-card-colored .stat-label {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 8px;
    opacity: .95;
}

.stat-card-colored .stat-value {
    font-size: 34px;
    font-weight: 800;
    margin: 0;
}

.card-employees {
    background: linear-gradient(135deg, #0d6efd, #084298);
}

.card-trainings {
    background: linear-gradient(135deg, #198754, #0f5132);
}

.card-events {
    background: linear-gradient(135deg, #fd7e14, #b45309);
}

.card-learning {
    background: linear-gradient(135deg, #6f42c1, #3d0a91);
}

.card-documents {
    background: linear-gradient(135deg, #20c997, #087f5b);
}

.card-pending {
    background: linear-gradient(135deg, #dc3545, #842029);
}

.month-year-card {
    background: #fff;
    border: none;
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    margin-bottom: 24px;
}

.month-year-card label {
    font-weight: 700;
    color: #0b3d91;
}
</style>

<div class="dashboard-topbar gov-topbar">
    <div>
        <div class="gov-agency">Learning Development Unit</div>
        <div class="dashboard-title">LDU Monitoring Dashboard</div>
    </div>

    <div class="gov-date">
        <i class="fa-solid fa-calendar-days me-2"></i>
        <?= date('F d, Y') ?>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>

<div class="dashboard-tabs-wrap d-flex flex-wrap gap-2 align-items-center">
    <a class="dashboard-tab <?= $activeTab === 'home' ? 'active' : '' ?>"
       href="/dashboard?tab=home&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>">
        <i class="fa-solid fa-house"></i> Home
    </a>

    <a class="dashboard-tab <?= $activeTab === 'calendar' ? 'active' : '' ?>"
       href="/dashboard?tab=calendar&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>">
        <i class="fa-solid fa-calendar-days"></i> Calendar
    </a>

    
</div>

<div id="homePanel" class="dashboard-panel <?= $activeTab === 'home' ? 'active' : '' ?>">

    <div class="card filter-card">
        <div class="card-body">
            <form method="get" class="row g-2 align-items-end">
                <input type="hidden" name="tab" value="home">

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Month</label>
                    <select name="month" class="form-select">
                        <?php for ($m = 1; $m <= 12; $m++): ?>
                            <option value="<?= $m ?>" <?= $selectedMonth === $m ? 'selected' : '' ?>>
                                <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Year</label>
                    <select name="year" class="form-select">
                        <?php for ($y = date('Y') - 5; $y <= date('Y') + 1; $y++): ?>
                            <option value="<?= $y ?>" <?= $selectedYear === $y ? 'selected' : '' ?>>
                                <?= $y ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-success w-100">
                        <i class="fa-solid fa-filter"></i> Apply
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-4">

    <div class="col-md-4 col-lg-2">
        <div class="stat-card-colored card-employees">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Employees</div>
                    <p class="stat-value"><?= esc($totalEmployees ?? 0) ?></p>
                </div>

                <div class="stat-icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2">
        <div class="stat-card-colored card-trainings">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Trainings</div>
                    <p class="stat-value"><?= esc($totalTrainings ?? 0) ?></p>
                </div>

                <div class="stat-icon">
                    <i class="fa fa-chalkboard-teacher"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2">
        <div class="stat-card-colored card-events">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Events</div>
                    <p class="stat-value"><?= esc($totalEvents ?? 0) ?></p>
                </div>

                <div class="stat-icon">
                    <i class="fa fa-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2">
        <div class="stat-card-colored card-learning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Learning</div>
                    <p class="stat-value"><?= esc($totalLearningEvents ?? 0) ?></p>
                </div>

                <div class="stat-icon">
                    <i class="fa fa-book"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2">
        <div class="stat-card-colored card-documents">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Documents</div>
                    <p class="stat-value"><?= esc($totalDocuments ?? 0) ?></p>
                </div>

                <div class="stat-icon">
                    <i class="fa fa-folder"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2">
        <div class="stat-card-colored card-pending">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Pending</div>
                    <p class="stat-value"><?= esc($pendingDocuments ?? 0) ?></p>
                </div>

                <div class="stat-icon">
                    <i class="fa fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

</div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card section-card">
                <div class="card-header training-header">
                    <i class="fa-solid fa-graduation-cap me-2"></i> Recent Training Events
                </div>
                <div class="card-body p-0">
                    <table class="table table-modern table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Title</th>
                                <th>Venue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentTrainings)): ?>
                                <?php foreach($recentTrainings as $t): ?>
                                    <tr>
                                        <td>
                                            <span class="soft-badge badge-green">
                                                <?= esc($t['name'] ?? '') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="title-text-green"><?= esc($t['title'] ?? '') ?></span>
                                        </td>
                                        <td>
                                            <span class="soft-badge badge-gray"><?= esc($t['venue'] ?? '') ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="empty-state">No training events yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card section-card">
                <div class="card-header event-header">
                    <i class="fa-solid fa-calendar-check me-2"></i> Recent Events
                </div>
                <div class="card-body p-0">
                    <table class="table table-modern table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Event Title</th>
                                <th>Venue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentEvents)): ?>
                                <?php foreach($recentEvents as $e): ?>
                                    <tr>
                                        <td>
                                            <span class="title-text-blue"><?= esc($e['title'] ?? '') ?></span>
                                        </td>
                                        <td>
                                            <span class="soft-badge badge-blue"><?= esc($e['venue'] ?? '') ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="empty-state">No events yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card section-card">
                <div class="card-header learning-header">
                    <i class="fa-solid fa-book-open me-2"></i> Recent Learning Events
                </div>
                <div class="card-body p-0">
                    <table class="table table-modern table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Title</th>
                                <th>Provider</th>
                                <th>Date From</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentLearningEvents)): ?>
                                <?php foreach($recentLearningEvents as $l): ?>
                                    <tr>
                                        <td>
                                            <span class="soft-badge badge-purple">
                                                <?= esc($l['employee_name'] ?? '') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="title-text-purple"><?= esc($l['title'] ?? '') ?></span>
                                        </td>
                                        <td><?= esc($l['provider'] ?? '') ?></td>
                                        <td>
                                            <span class="soft-badge badge-gray"><?= esc($l['date_from'] ?? '') ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="empty-state">No learning events yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card section-card">
                <div class="card-header document-header">
                    <i class="fa-solid fa-folder-open me-2"></i> Recent Documents
                </div>
                <div class="card-body p-0">
                    <table class="table table-modern table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Tracking No.</th>
                                <th>Title</th>
                                <th>Date Received</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentDocuments)): ?>
                                <?php foreach($recentDocuments as $d): ?>
                                    <tr>
                                        <td>
                                            <span class="soft-badge badge-gray">
                                                <?= esc($d['employee_name'] ?? '') ?>
                                            </span>
                                        </td>
                                        <td><?= esc($d['iis_tracking_no'] ?? '') ?></td>
                                        <td>
                                            <span class="title-text-dark"><?= esc($d['title_of_document'] ?? ($d['document_title'] ?? '')) ?></span>
                                        </td>
                                        <td>
                                            <span class="soft-badge badge-red"><?= esc($d['date_received_office'] ?? ($d['date_submitted'] ?? '')) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="empty-state">No documents yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card quick-card">
                <div class="card-body">
                    <h5 class="mb-3">Quick Actions</h5>

                    <a href="/employees/create" class="quick-link">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Add Employee</span>
                    </a>

                    <a href="/events/create" class="quick-link">
                        <i class="fa-solid fa-calendar-plus"></i>
                        <span>Add Event</span>
                    </a>

                    <a href="/learning-events/create" class="quick-link">
                        <i class="fa-solid fa-book-open"></i>
                        <span>Add Learning Event</span>
                    </a>

                    <a href="/documents/create" class="quick-link">
                        <i class="fa-solid fa-folder-plus"></i>
                        <span>Add Document</span>
                    </a>
                </div>
            </div>

            <div class="card info-box mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Current Filter</h5>
                    <div class="mb-2">
                        <strong>Month:</strong>
                        <?= date('F', mktime(0, 0, 0, $selectedMonth, 1)) ?>
                    </div>
                    <div class="mb-2">
                        <strong>Year:</strong>
                        <?= esc($selectedYear) ?>
                    </div>
                </div>
            </div>

            <div class="card info-box">
                <div class="card-body">
                    <h5 class="mb-3">Pending Documents</h5>
                    <div class="alert alert-danger mb-0">
                        <strong><?= esc($pendingDocuments ?? 0) ?></strong> document(s) still pending.
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<div id="calendarPanel" class="dashboard-panel <?= $activeTab === 'calendar' ? 'active' : '' ?>">

    <div class="card filter-card">
        <div class="card-body">
            <form method="get" class="row g-2 align-items-end">
                <input type="hidden" name="tab" value="calendar">

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Month</label>
                    <select name="month" class="form-select">
                        <?php for ($m = 1; $m <= 12; $m++): ?>
                            <option value="<?= $m ?>" <?= $selectedMonth === $m ? 'selected' : '' ?>>
                                <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Year</label>
                    <select name="year" class="form-select">
                        <?php for ($y = date('Y') - 5; $y <= date('Y') + 1; $y++): ?>
                            <option value="<?= $y ?>" <?= $selectedYear === $y ? 'selected' : '' ?>>
                                <?= $y ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-success w-100">
                        <i class="fa-solid fa-filter"></i> Apply
                    </button>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#scheduleModal">
                        <i class="fa-solid fa-plus"></i> Add Schedule
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="/dashboard?tab=calendar&month=<?= date('n') ?>&year=<?= date('Y') ?>" class="btn btn-warning w-100">
                        Today
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="calendar-legend">
        <div class="legend-item">
            <span class="legend-color" style="background:#e8f1ff;border-left:4px solid #0b3d91;"></span>
            Scheduled Event
        </div>
        <div class="legend-item">
            <span class="legend-color" style="background:#fffbea;border:1px solid #ffc107;"></span>
            Today
        </div>
    </div>

    <div class="card section-card">
        <div class="calendar-header d-flex justify-content-between align-items-center">
            <a href="/dashboard?tab=calendar&month=<?= $prevMonth ?>&year=<?= $prevYear ?>" class="btn btn-sm btn-light">
                <i class="fa-solid fa-chevron-left"></i>
            </a>

            <h4 class="mb-0"><?= date('F Y', $firstDayOfMonth) ?></h4>

            <a href="/dashboard?tab=calendar&month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="btn btn-sm btn-light">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>

        <div class="calendar-grid">
            <?php foreach (['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $dayName): ?>
                <div class="calendar-day-name"><?= $dayName ?></div>
            <?php endforeach; ?>

            <?php for ($i = 0; $i < $startDayOfWeek; $i++): ?>
                <div class="calendar-cell empty"></div>
            <?php endfor; ?>

            <?php for ($day = 1; $day <= $daysInMonth; $day++): ?>
                <?php
                $dateKey = $selectedYear . '-' . str_pad($selectedMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                $isToday = $dateKey === date('Y-m-d');
                $dayEvents = $eventsByDate[$dateKey] ?? [];
                ?>
                <div class="calendar-cell <?= $isToday ? 'today-cell' : '' ?>"
                     data-date="<?= $dateKey ?>"
                     onclick="openScheduleModal('<?= $dateKey ?>')">
                    <div class="calendar-date"><?= $day ?></div>

                    <?php if (!empty($dayEvents)): ?>
                        <?php
                        $shownEvents = array_slice($dayEvents, 0, 2);
                        $moreCount = count($dayEvents) - count($shownEvents);
                        ?>
<?php foreach ($shownEvents as $event): ?>
    <div class="calendar-event-link"
         onclick="openEventDetails(
            event,
            '<?= esc($event['title'] ?? '', 'js') ?>',
            '<?= esc($dateKey ?? '', 'js') ?>',
            '<?= esc($event['iis_no'] ?? '', 'js') ?>',
            '<?= esc($event['special_order_no'] ?? '', 'js') ?>',
            '<?= esc($event['conducted_by'] ?? '', 'js') ?>',
            '<?= esc($event['venue'] ?? '', 'js') ?>',
            '<?= esc($event['remarks'] ?? '', 'js') ?>'
         ); return false;">

        <div class="calendar-event">
            <div class="calendar-event-title">
                <?= esc($event['title'] ?? '') ?>
            </div>

            <div class="calendar-event-venue">
                <?= esc($event['venue'] ?? '') ?>
            </div>
        </div>

    </div>
<?php endforeach; ?>
                        <?php if ($moreCount > 0): ?>
                            <div class="small text-primary fw-bold">+<?= $moreCount ?> more</div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>

            <?php
            $totalCellsUsed = $startDayOfWeek + $daysInMonth;
            $remainingCells = (7 - ($totalCellsUsed % 7)) % 7;
            ?>
            <?php for ($i = 0; $i < $remainingCells; $i++): ?>
                <div class="calendar-cell empty"></div>
            <?php endfor; ?>
        </div>
    </div>
</div>


<!-- SCHEDULE MODAL -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="/dashboard/store-calendar-event">
                <?= csrf_field() ?>

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Schedule</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Event Date</label>
                            <input type="date" name="event_date" id="schedule_event_date" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">IIS No.</label>
                            <input type="text" name="iis_no" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Special Order No.</label>
                            <input type="text" name="special_order_no" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Event Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Conducted By</label>
                            <input type="text" name="conducted_by" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Schedule</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- EVENT DETAILS MODAL -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Event Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <h5 id="detailTitle" class="fw-bold text-primary mb-3"></h5>

                <p><strong>Date:</strong> <span id="detailDate"></span></p>
                <p><strong>IIS No.:</strong> <span id="detailIis"></span></p>
                <p><strong>Special Order No.:</strong> <span id="detailSpecialOrder"></span></p>
                <p><strong>Conducted By:</strong> <span id="detailConductedBy"></span></p>
                <p><strong>Venue:</strong> <span id="detailVenue"></span></p>
                <p><strong>Remarks:</strong> <span id="detailRemarks"></span></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- REPORT MODAL -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/dashboard/store-report">
                <?= csrf_field() ?>

                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Submit Report</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Employee</label>
                        <select name="employee_id" class="form-select" required>
                            <option value="">Select Employee</option>
                            <?php if (!empty($employees)): ?>
                                <?php foreach ($employees as $emp): ?>
                                    <option value="<?= $emp['id'] ?>">
                                        <?= esc($emp['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="4" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-info text-white">Send Report</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function openEventDetails(e, title, date, iisNo, specialOrderNo, conductedBy, venue, remarks) {
    e.preventDefault();
    e.stopPropagation();

    document.getElementById('detailTitle').innerText = title || 'No title';
    document.getElementById('detailDate').innerText = date || 'N/A';
    document.getElementById('detailIis').innerText = iisNo || 'N/A';
    document.getElementById('detailSpecialOrder').innerText = specialOrderNo || 'N/A';
    document.getElementById('detailConductedBy').innerText = conductedBy || 'N/A';
    document.getElementById('detailVenue').innerText = venue || 'N/A';
    document.getElementById('detailRemarks').innerText = remarks || 'N/A';

    const modal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
    modal.show();

    return false;
}

function openScheduleModal(dateValue) {
    const input = document.getElementById('schedule_event_date');
    input.value = dateValue;

    const modal = new bootstrap.Modal(document.getElementById('scheduleModal'));
    modal.show();
}

async function loadNotifications() {
    try {
        const res = await fetch('/dashboard/notifications');
        const data = await res.json();

        if (!data.success) return;

        const badge = document.getElementById('notifBadge');
        const list = document.getElementById('notifList');

        if (data.unread_count > 0) {
            badge.style.display = 'flex';
            badge.innerText = data.unread_count;
        } else {
            badge.style.display = 'none';
        }

        if (!data.items || data.items.length === 0) {
            list.innerHTML = '<div class="p-3 text-muted">No notifications</div>';
            return;
        }

        let html = '';
        data.items.forEach(item => {
            html += `
                <a href="/dashboard?tab=messages"
                   onclick="markNotificationRead(${item.id})"
                   class="notif-item">
                    <div class="notif-item-title">${item.employee_name ?? 'Employee'}</div>
                    <div class="notif-item-text">${item.subject}</div>
                    <div class="notif-item-time">${item.created_at}</div>
                </a>
            `;
        });

        list.innerHTML = html;
    } catch (e) {
        console.log(e);
    }
}

async function markNotificationRead(id) {
    try {
        await fetch('/dashboard/notifications/read/' + id, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        loadNotifications();
    } catch (e) {
        console.log(e);
    }
}

async function markAllNotificationsRead() {
    try {
        await fetch('/dashboard/notifications/read-all', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        loadNotifications();
    } catch (e) {
        console.log(e);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    loadNotifications();
    setInterval(loadNotifications, 10000);
});
</script>

<?= $this->endSection() ?>