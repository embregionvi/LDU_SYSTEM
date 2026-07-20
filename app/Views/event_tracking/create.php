<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Add Event Tracking</h2>

    <a href="/event-tracking" class="btn btn-secondary">
        Back
    </a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div><?= esc($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<!-- ADD EVENT TRACKING MODAL -->
<div class="modal fade" id="addEventTrackingModal" tabindex="-1" aria-labelledby="addEventTrackingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addEventTrackingModalLabel">Add Event Tracking</h5>
                <a href="/event-tracking" class="btn-close btn-close-white"></a>
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

                    <a href="/event-tracking" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.getElementById('addEventTrackingModal');

    if (modalElement) {
        const modal = new bootstrap.Modal(modalElement, {
            backdrop: 'static',
            keyboard: false
        });

        modal.show();
    }
});
</script>

<?= $this->endSection() ?>