<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Learning Event</h3>

<div class="card">
    <div class="card-header bg-warning text-dark">
        Update Record
    </div>

    <div class="card-body">

        <form method="post" action="/learning-events/update/<?= $event['id'] ?>">

            <input type="text" name="iis_no" value="<?= esc($event['iis_no']) ?>" class="form-control mb-2">

            <input type="text" name="special_order_no" value="<?= esc($event['special_order_no']) ?>" class="form-control mb-2">

            <textarea name="title" class="form-control mb-2"><?= esc($event['title']) ?></textarea>

            <input type="text" name="provider" value="<?= esc($event['provider']) ?>" class="form-control mb-2">

            <input type="text" name="type_learning" value="<?= esc($event['type_learning']) ?>" class="form-control mb-2">

            <input type="text" name="office" value="<?= esc($event['office']) ?>" class="form-control mb-2">

            <div class="row">
                <div class="col-md-6">
                    <input type="date" name="date_from" value="<?= $event['date_from'] ?>" class="form-control mb-2">
                </div>
                <div class="col-md-6">
                    <input type="date" name="date_to" value="<?= $event['date_to'] ?>" class="form-control mb-2">
                </div>
            </div>

            <input type="number" name="cost" value="<?= $event['cost'] ?>" class="form-control mb-2">

            <input type="number" name="training_hours" value="<?= $event['training_hours'] ?>" class="form-control mb-2">

            <input type="text" name="venue" value="<?= esc($event['venue']) ?>" class="form-control mb-2">

            <input type="text" name="sponsor" value="<?= esc($event['sponsor']) ?>" class="form-control mb-2">

            <div class="row">
                <div class="col-md-4">
                    <input type="number" name="male" value="<?= $event['male'] ?>" class="form-control mb-2" id="male">
                </div>
                <div class="col-md-4">
                    <input type="number" name="female" value="<?= $event['female'] ?>" class="form-control mb-2" id="female">
                </div>
                <div class="col-md-4">
                    <!-- AUTO TOTAL -->
                    <input type="number" name="total" value="<?= $event['total'] ?>" class="form-control mb-2" id="total" readonly>
                </div>
            </div>

            <textarea name="remarks" class="form-control mb-2"><?= esc($event['remarks']) ?></textarea>

            <input type="text" name="travel_expense" value="<?= esc($event['travel_expense']) ?>" class="form-control mb-3">

            <button class="btn btn-primary">Update</button>

        </form>

    </div>
</div>

<!-- ✅ AUTO COMPUTE -->
<script>
const male = document.getElementById('male');
const female = document.getElementById('female');
const total = document.getElementById('total');

function computeTotal(){
    let m = parseInt(male.value) || 0;
    let f = parseInt(female.value) || 0;
    total.value = m + f;
}

male.addEventListener('input', computeTotal);
female.addEventListener('input', computeTotal);
</script>

<?= $this->endSection() ?>