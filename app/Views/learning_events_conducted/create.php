<!-- ADD MODAL -->
<div class="modal fade" id="addConductedModal" tabindex="-1" aria-labelledby="addConductedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addConductedModalLabel">Add Learning Event Conducted</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" action="/learning-events-conducted/store">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">RSO No.</label>
                            <input type="text" name="rso_no" class="form-control" value="<?= old('rso_no') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Special Order No.</label>
                            <input type="text" name="special_order_no" class="form-control" value="<?= old('special_order_no') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Learning Service Provider</label>
                            <input type="text" name="service_provider" class="form-control" value="<?= old('service_provider') ?>">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Learning Title</label>
                        <textarea name="title" class="form-control" required><?= old('title') ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Competency</label>
                            <input type="text" name="competency" class="form-control" value="<?= old('competency') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Type of Learning and Development</label>
                            <input type="text" name="type_learning" class="form-control" value="<?= old('type_learning') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Learning Administrator</label>
                            <input type="text" name="learning_administrator" class="form-control" value="<?= old('learning_administrator') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Office/Organization</label>
                            <input type="text" name="office_organization" class="form-control" value="<?= old('office_organization') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Date From</label>
                            <input type="date" name="date_from" class="form-control" value="<?= old('date_from') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Date To</label>
                            <input type="date" name="date_to" class="form-control" value="<?= old('date_to') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Cost</label>
                            <input type="number" step="0.01" name="cost" class="form-control" value="<?= old('cost') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Training Hours</label>
                            <input type="number" name="training_hours" class="form-control" value="<?= old('training_hours') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control" value="<?= old('venue') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Sponsor</label>
                            <input type="text" name="sponsor" class="form-control" value="<?= old('sponsor') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Male</label>
                            <input type="number" name="male" id="add_male" class="form-control" value="<?= old('male') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Female</label>
                            <input type="number" name="female" id="add_female" class="form-control" value="<?= old('female') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Total</label>
                            <input type="number" name="total" id="add_total" class="form-control" value="<?= old('total') ?>" readonly>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Attendance Sheets</label>
                            <input type="text" name="attendance_sheets" class="form-control" value="<?= old('attendance_sheets') ?>">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="form-label">Training Report Submission</label>
                            <input type="text" name="training_report_submission" class="form-control" value="<?= old('training_report_submission') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Evaluation</label>
                            <input type="text" name="evaluation" class="form-control" value="<?= old('evaluation') ?>">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label">Remarks (Participants)</label>
                            <textarea name="remarks_participants" class="form-control"><?= old('remarks_participants') ?></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Record</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>