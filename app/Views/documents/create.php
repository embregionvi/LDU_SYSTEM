<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Add Document Tracking</h3>

<div class="card">
    <div class="card-header bg-success text-white">Add Document</div>
    <div class="card-body">

        <form method="post" action="/documents/store">
            <?= csrf_field() ?>

            <input type="text" name="iis_tracking_no" placeholder="IIS Tracking No." class="form-control mb-2" required>

            <textarea name="title_of_document" placeholder="Title of Document" class="form-control mb-2" required></textarea>

            <div class="row">
                <div class="col-md-6">
                    <label>Date Received by the Office</label>
                    <input type="date" name="date_received_office" class="form-control mb-2">
                </div>
                <div class="col-md-6">
                    <label>Date Received by LDU</label>
                    <input type="date" name="date_received_ldu" class="form-control mb-2">
                </div>
            </div>

            <input type="text" name="received_from" placeholder="Received From" class="form-control mb-2">

            <textarea name="recent_remarks" placeholder="Recent Remarks (As Indicated)" class="form-control mb-2"></textarea>

            <textarea name="action_taken" placeholder="Action Taken" class="form-control mb-2"></textarea>

            <label>Date Accomplished</label>
            <input type="date" name="date_accomplished" class="form-control mb-2">

            <textarea name="remarks" placeholder="Remarks" class="form-control mb-3"></textarea>

            <button class="btn btn-success">Save Document</button>
        </form>

    </div>
</div>

<?= $this->endSection() ?>