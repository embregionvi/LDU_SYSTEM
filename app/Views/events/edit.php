<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Edit Event</h3>

<div class="card">
    <div class="card-body">
        <form method="post" action="/events/update/<?= $event['id'] ?>">

            <div class="mb-3">
                <label class="form-label">Related Training</label>
                <select name="training_id" class="form-control">
                    <option value="">Select Training</option>
                    <?php if (!empty($trainings)): ?>
                        <?php foreach ($trainings as $t): ?>
                            <option value="<?= $t['id'] ?>" <?= (($event['training_id'] ?? '') == $t['id']) ? 'selected' : '' ?>>
                                <?= esc($t['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Event Date</label>
                <input type="date" name="event_date" value="<?= esc($event['event_date']) ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">IIS No.</label>
                <input type="text" name="iis_no" value="<?= esc($event['iis_no']) ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Special Order No.</label>
                <input type="text" name="special_order_no" value="<?= esc($event['special_order_no']) ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <textarea name="title" class="form-control" rows="3"><?= esc($event['title']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Conducted By</label>
                <input type="text" name="conducted_by" value="<?= esc($event['conducted_by']) ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Venue</label>
                <input type="text" name="venue" value="<?= esc($event['venue']) ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Participants</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="selectAllEmployeesEdit">
                    <label class="form-check-label" for="selectAllEmployeesEdit">
                        Select All
                    </label>
                </div>

                <select name="employee_ids[]" id="employeeSelectEdit" class="form-control" multiple size="10">
                    <?php if (!empty($employees)): ?>
                        <?php foreach ($employees as $e): ?>
                            <option value="<?= $e['id'] ?>" <?= in_array($e['id'], $selected_ids) ? 'selected' : '' ?>>
                                <?= esc($e['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <small class="text-muted">Hold Ctrl (or Cmd on Mac) to select multiple employees.</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" class="form-control" rows="3"><?= esc($event['remarks']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Event</button>
            <a href="/events" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>

<script>
document.getElementById('selectAllEmployeesEdit').addEventListener('change', function () {
    const select = document.getElementById('employeeSelectEdit');
    for (let option of select.options) {
        option.selected = this.checked;
    }
});
</script>

<?= $this->endSection() ?>