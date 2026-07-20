<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<a href="/employees" class="btn btn-secondary mb-3">Back to Employees</a>

<!-- Edit Employee Modal -->
<div class="modal fade show" id="editEmployeeModal" tabindex="-1"
     style="display:block; background:rgba(0,0,0,0.5);"
     aria-modal="true" role="dialog">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Employee</h5>
                <a href="/employees" class="btn-close btn-close-white"></a>
            </div>

            <form method="post" action="/employees/update/<?= $employee['id'] ?>">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Employee Code</label>
                        <input type="text" name="employee_code"
                               value="<?= old('employee_code', $employee['employee_code']) ?>"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name"
                               value="<?= old('name', $employee['name']) ?>"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <input type="text" name="position"
                               value="<?= old('position', $employee['position']) ?>"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Employment Type</label>
                        <select name="employment_type" class="form-control" required>
                            <option value="Permanent"
                                <?= old('employment_type', $employee['employment_type']) == 'Permanent' ? 'selected' : '' ?>>
                                Permanent
                            </option>
                            <option value="COS"
                                <?= old('employment_type', $employee['employment_type']) == 'COS' ? 'selected' : '' ?>>
                                COS
                            </option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <a href="/employees" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Employee</button>
                </div>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>