<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.document-card{
    border:0;
    border-radius:14px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
    overflow:hidden;
}

.table thead th{
    background:#0b3d91 !important;
    color:#fff;
    font-size:13px;
    text-align:center;
    vertical-align:middle;
}

.table td{
    font-size:13px;
    vertical-align:middle;
}

.badge-status{
    padding:7px 10px;
    border-radius:20px;
    font-size:12px;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Document Tracking</h2>

    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
        <i class="fa fa-plus"></i> Add Document
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

<form method="get" class="row g-2 mb-3">
    <div class="col-md-5">
        <input type="text" name="search" value="<?= esc($search ?? '') ?>"
               class="form-control" placeholder="Search document...">
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">
            <i class="fa fa-search"></i> Search
        </button>
    </div>
</form>

<div class="card document-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>IIS Tracking No.</th>
                        <th>Title of Document</th>
                        <th>Date Received Office</th>
                        <th>Date Received LDU</th>
                        <th>Received From</th>
                        <th>Recent Remarks</th>
                        <th>Action Taken</th>
                        <th>Date Accomplished</th>
                        <th>Remarks</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($documents)): ?>
                        <?php foreach ($documents as $d): ?>
                            <tr>
                                <td><?= esc($d['iis_tracking_no'] ?? '') ?></td>
                                <td class="fw-semibold"><?= esc($d['document_title'] ?? '') ?></td>
                                <td><?= esc($d['date_received_office'] ?? '') ?></td>
                                <td><?= esc($d['date_received_ldu'] ?? '') ?></td>
                                <td><?= esc($d['received_from'] ?? '') ?></td>
                                <td><?= esc($d['recent_remarks'] ?? '') ?></td>
                                <td><?= esc($d['action_taken'] ?? '') ?></td>
                                <td><?= esc($d['date_accomplished'] ?? '') ?></td>
                                <td><?= esc($d['remarks'] ?? '') ?></td>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-warning btn-sm edit-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editDocumentModal"
                                        data-id="<?= esc($d['id']) ?>"
                                        data-iis_tracking_no="<?= esc($d['iis_tracking_no'] ?? '') ?>"
                                        data-title_of_document="<?= esc($d['document_title'] ?? '') ?>"
                                        data-date_received_office="<?= esc($d['date_received_office'] ?? '') ?>"
                                        data-date_received_ldu="<?= esc($d['date_received_ldu'] ?? '') ?>"
                                        data-received_from="<?= esc($d['received_from'] ?? '') ?>"
                                        data-recent_remarks="<?= esc($d['recent_remarks'] ?? '') ?>"
                                        data-action_taken="<?= esc($d['action_taken'] ?? '') ?>"
                                        data-date_accomplished="<?= esc($d['date_accomplished'] ?? '') ?>"
                                        data-remarks="<?= esc($d['remarks'] ?? '') ?>"
                                    >
                                        Edit
                                    </button>

                                    <a href="/documents/delete/<?= esc($d['id']) ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Delete this document?')">
                                       Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                No documents found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- ADD DOCUMENT MODAL -->
<div class="modal fade" id="addDocumentModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Document Tracking</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" action="/documents/store">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">IIS Tracking No.</label>
                        <input type="text" name="iis_tracking_no" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title of Document</label>
                        <textarea name="title_of_document" class="form-control" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date Received by the Office</label>
                            <input type="date" name="date_received_office" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date Received by LDU</label>
                            <input type="date" name="date_received_ldu" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Received From</label>
                        <input type="text" name="received_from" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Recent Remarks</label>
                        <textarea name="recent_remarks" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Action Taken</label>
                        <textarea name="action_taken" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date Accomplished</label>
                        <input type="date" name="date_accomplished" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Save Document</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- EDIT DOCUMENT MODAL -->
<div class="modal fade" id="editDocumentModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-warning">
                <h5 class="modal-title">Edit Document Tracking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" id="editDocumentForm">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">IIS Tracking No.</label>
                        <input type="text" name="iis_tracking_no" id="edit_iis_tracking_no" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title of Document</label>
                        <textarea name="title_of_document" id="edit_title_of_document" class="form-control" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date Received by the Office</label>
                            <input type="date" name="date_received_office" id="edit_date_received_office" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date Received by LDU</label>
                            <input type="date" name="date_received_ldu" id="edit_date_received_ldu" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Received From</label>
                        <input type="text" name="received_from" id="edit_received_from" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Recent Remarks</label>
                        <textarea name="recent_remarks" id="edit_recent_remarks" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Action Taken</label>
                        <textarea name="action_taken" id="edit_action_taken" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date Accomplished</label>
                        <input type="date" name="date_accomplished" id="edit_date_accomplished" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" id="edit_remarks" class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update Document</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.dataset.id;

        document.getElementById('editDocumentForm').action = '/documents/update/' + id;

        document.getElementById('edit_iis_tracking_no').value = this.dataset.iis_tracking_no || '';
        document.getElementById('edit_title_of_document').value = this.dataset.title_of_document || '';
        document.getElementById('edit_date_received_office').value = this.dataset.date_received_office || '';
        document.getElementById('edit_date_received_ldu').value = this.dataset.date_received_ldu || '';
        document.getElementById('edit_received_from').value = this.dataset.received_from || '';
        document.getElementById('edit_recent_remarks').value = this.dataset.recent_remarks || '';
        document.getElementById('edit_action_taken').value = this.dataset.action_taken || '';
        document.getElementById('edit_date_accomplished').value = this.dataset.date_accomplished || '';
        document.getElementById('edit_remarks').value = this.dataset.remarks || '';
    });
});
</script>

<?= $this->endSection() ?>