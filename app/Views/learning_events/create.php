<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Learning Events</h3>

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLearningEventModal">
        <i class="fa fa-plus"></i> Add Learning Event
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


<!-- ADD LEARNING EVENT MODAL -->
<div class="modal fade" id="addLearningEventModal" tabindex="-1" aria-labelledby="addLearningEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addLearningEventModalLabel">Add Learning Event</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" action="/learning-events/store">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <!-- ROW 1 -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">IIS No.</label>
                            <input type="text" name="iis_no" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Special Order No.</label>
                            <input type="text" name="special_order_no" class="form-control">
                        </div>
                    </div>

                    <!-- TITLE -->
                    <div class="mb-3">
                        <label class="form-label">Learning Title</label>
                        <textarea name="title" class="form-control" rows="3" required></textarea>
                    </div>

                    <!-- PROVIDER + TYPE -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Learning Service Provider</label>
                            <input type="text" name="provider" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type of Learning</label>
                            <input type="text" name="type_learning" class="form-control">
                        </div>
                    </div>

                    <!-- OFFICE -->
                    <div class="mb-3">
                        <label class="form-label">Office / Agency</label>
                        <input type="text" name="office" class="form-control">
                    </div>

                    <!-- DATE -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date From</label>
                            <input type="date" name="date_from" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date To</label>
                            <input type="date" name="date_to" class="form-control">
                        </div>
                    </div>

                    <!-- COST + HOURS -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cost (Registration)</label>
                            <input type="number" name="cost" class="form-control" step="0.01">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Training Hours</label>
                            <input type="number" name="training_hours" class="form-control" step="0.01">
                        </div>
                    </div>

                    <!-- VENUE + SPONSOR -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sponsor</label>
                            <input type="text" name="sponsor" class="form-control">
                        </div>
                    </div>

                    <!-- REMARKS -->
                    <div class="mb-3">
                        <label class="form-label">Remarks (Participants)</label>
                        <textarea name="remarks" class="form-control" rows="2"></textarea>
                    </div>

                    <!-- PARTICIPANTS -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Male</label>
                            <input type="number" name="male" id="male" class="form-control" min="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Female</label>
                            <input type="number" name="female" id="female" class="form-control" min="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Total</label>
                            <input type="number" name="total" id="total" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- TRAVEL -->
                    <div class="mb-3">
                        <label class="form-label">Traveling Expenses</label>
                        <input type="text" name="travel_expense" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Save Record
                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- AUTO COMPUTE TOTAL -->
<script>
const male = document.getElementById('male');
const female = document.getElementById('female');
const total = document.getElementById('total');

function computeTotal() {
    let m = parseInt(male.value) || 0;
    let f = parseInt(female.value) || 0;
    total.value = m + f;
}

male.addEventListener('input', computeTotal);
female.addEventListener('input', computeTotal);
</script>

<?= $this->endSection() ?>