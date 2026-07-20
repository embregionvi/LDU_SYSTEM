<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Document Tracking</h3>

<div class="card">
    <div class="card-header bg-warning">Update Document</div>
    <div class="card-body">

        <form method="post" action="/documents/update/<?= $document['id'] ?>">
            <?= csrf_field() ?>

            <div class="mb-2">
                <label class="form-label">Employee</label>
                <select name="employee_id" class="form-control" required>
                    <option value="">Select Employee</option>
                    <?php if (!empty($employees)): ?>
                        <?php foreach ($employees as $emp): ?>
                            <option value="<?= $emp['id'] ?>" <?= (($document['employee_id'] ?? '') == $emp['id']) ? 'selected' : '' ?>>
                                <?= esc($emp['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label">Document Title</label>
                <textarea name="document_title" class="form-control" required><?= esc($document['document_title'] ?? '') ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" value="<?= esc($document['status'] ?? '') ?>" class="form-control mb-2">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date Submitted</label>
                    <input type="date" name="date_submitted" value="<?= esc($document['date_submitted'] ?? '') ?>" class="form-control mb-2">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" class="form-control"><?= esc($document['remarks'] ?? '') ?></textarea>
            </div>

            <button class="btn btn-primary">Update Document</button>
            <a href="/documents" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
</div>

<?= $this->endSection() ?>