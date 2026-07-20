<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.event-card {
    border: 0;
    border-radius: 14px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
}

.table thead th {
    background: #0b3d91 !important;
    color: #fff;
    font-size: 13px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}

.table td {
    font-size: 13px;
    vertical-align: middle;
}

.event-title {
    min-width: 400px;
}

.participants-cell {
    min-width: 180px;
}

.remarks-cell {
    min-width: 180px;
}

/* MODAL FIX */
#addEventTrackingModal .modal-dialog {
    max-width: 85%;
}

#addEventTrackingModal .modal-content {
    max-height: 90vh;
}

#addEventTrackingModal .modal-body {
    overflow-y: auto;
    max-height: calc(90vh - 140px);
}
</style>

<?php
    $eventList = $events ?? $eventTracking ?? $event_tracking ?? [];
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Event Tracking</h2>

    <!-- ADD BUTTON THAT OPENS MODAL -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventTrackingModal">
        <i class="fa fa-plus"></i> Add Event
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

<div class="card event-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>Event Date</th>
                        <th>IIS No.</th>
                        <th>Special Order No.</th>
                        <th>Learning Title</th>
                        <th>Conducted By</th>
                        <th>Venue</th>
                        <th>Participants</th>
                        <th>Remarks/Updates</th>
                        <th width="140">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($eventList)): ?>
                        <?php foreach ($eventList as $event): ?>
                            <tr>
                                <td><?= esc($event['event_date'] ?? '') ?></td>
                                <td><?= esc($event['iis_no'] ?? '') ?></td>
                                <td><?= esc($event['special_order_no'] ?? '') ?></td>
                                <td class="event-title"><?= esc($event['learning_title'] ?? '') ?></td>
                                <td><?= esc($event['conducted_by'] ?? '') ?></td>
                                <td><?= esc($event['venue'] ?? '') ?></td>
                                <td class="participants-cell"><?= esc($event['participants'] ?? '') ?></td>
                                <td class="remarks-cell"><?= esc($event['remarks_updates'] ?? '') ?></td>

                                <td class="text-center">
                                    <a href="/event-tracking/edit/<?= esc($event['id'] ?? '') ?>" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <a href="/event-tracking/delete/<?= esc($event['id'] ?? '') ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Delete this event?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                No event records found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>


<!-- ADD EVENT TRACKING MODAL -->
<div class="modal fade" id="addEventTrackingModal" tabindex="-1" aria-labelledby="addEventTrackingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addEventTrackingModalLabel">Add Event Tracking</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" action="/event-tracking/store">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Event Date</label>
                            <input 
                                type="text" 
                                name="event_date" 
                                class="form-control" 
                                placeholder="Example: February 2-5, 2026"
                                value="<?= old('event_date') ?>"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">IIS No.</label>
                            <input 
                                type="text" 
                                name="iis_no" 
                                class="form-control" 
                                placeholder="Example: R6-2026-001277"
                                value="<?= old('iis_no') ?>"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Special Order No.</label>
                            <input 
                                type="text" 
                                name="special_order_no" 
                                class="form-control" 
                                placeholder="Example: RSO. NO. 6 S. 2026"
                                value="<?= old('special_order_no') ?>"
                            >
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Learning Title</label>
                        <textarea 
                            name="learning_title" 
                            class="form-control" 
                            rows="4" 
                            required
                        ><?= old('learning_title') ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Conducted By</label>
                            <input 
                                type="text" 
                                name="conducted_by" 
                                class="form-control" 
                                placeholder="Example: UNDP"
                                value="<?= old('conducted_by') ?>"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Venue</label>
                            <input 
                                type="text" 
                                name="venue" 
                                class="form-control" 
                                placeholder="Example: Metro Manila"
                                value="<?= old('venue') ?>"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Participants</label>
                            <textarea 
                                name="participants" 
                                class="form-control" 
                                rows="2"
                                placeholder="Example: N. Agsaluna, C. Calapa-an, M. Zerrudo, R. Valle"
                            ><?= old('participants') ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks/Updates</label>
                        <textarea 
                            name="remarks_updates" 
                            class="form-control" 
                            rows="3"
                            placeholder="Example: Event Done / To follow up ILR / Waiting for 1CPD"
                        ><?= old('remarks_updates') ?></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Save Event
                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>