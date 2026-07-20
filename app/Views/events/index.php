<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2 class="mb-3">Event Tracking</h2>

<div class="mb-3">
    <a href="/events/create" class="btn btn-success">Add Event</a>
</div>

<style>
.event-wrap{
    overflow-x:auto;
}

.event-table{
    width:100%;
    min-width:1500px;
    border-collapse:collapse;
    background:#fff;
}

.event-table th,
.event-table td{
    border:1px solid #222;
    padding:6px 8px;
    font-size:13px;
    vertical-align:top;
}

.event-table thead th{
    background:#234f96;
    color:#fff;
    text-align:center;
    vertical-align:middle;
    font-weight:700;
    font-size:14px;
}

.event-table tbody td{
    background:#f4f4f4;
    line-height:1.4;
}

.event-table tbody tr:nth-child(even) td{
    background:#ededed;
}

.event-table td:nth-child(1){
    min-width:120px;
}

.event-table td:nth-child(2){
    min-width:85px;
}

.event-table td:nth-child(3){
    min-width:120px;
    color:#d40000;
}

.event-table td:nth-child(4){
    min-width:540px;
}

.event-table td:nth-child(5){
    min-width:140px;
    text-align:center;
}

.event-table td:nth-child(6){
    min-width:160px;
    text-align:center;
}

.event-table td:nth-child(7){
    min-width:160px;
    color:#d40000;
    text-align:center;
}

.event-table td:nth-child(8){
    min-width:170px;
    text-align:center;
}

.event-table td:nth-child(9){
    min-width:110px;
    text-align:center;
}

.action-buttons{
    display:flex;
    flex-direction:column;
    gap:6px;
}

.action-buttons .btn{
    font-size:12px;
    padding:4px 8px;
}

.center-text{
    text-align:center;
}
</style>

<div class="event-wrap">
    <table class="event-table">
        <thead>
            <tr>
                <th>Event Date</th>
                <th>IIS No.</th>
                <th>Special Order No.</th>
                <th>Learning Title</th>
                <th>Conducted By</th>
                <th>Venue</th>
                <th>Participants</th>
                <th>Remarks / Updates</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $e): ?>

                <?php
                $db = \Config\Database::connect();

                $participants = $db->table('event_participants ep')
                    ->select('employees.name')
                    ->join('employees', 'employees.id = ep.employee_id')
                    ->where('ep.event_id', $e['id'])
                    ->get()
                    ->getResultArray();

                $selected = $db->table('event_participants')
                    ->where('event_id', $e['id'])
                    ->get()
                    ->getResultArray();

                $selected_ids = array_column($selected, 'employee_id');

                $employees = $db->table('employees')->get()->getResultArray();

                $participantNames = !empty($participants)
                    ? implode(', ', array_column($participants, 'name'))
                    : 'None';
                ?>

                <tr>
                    <td><?= esc($e['event_date']) ?></td>
                    <td><?= esc($e['iis_no']) ?></td>
                    <td><?= esc($e['special_order_no']) ?></td>
                    <td><?= esc($e['title']) ?></td>
                    <td><?= esc($e['conducted_by']) ?></td>
                    <td><?= esc($e['venue']) ?></td>
                    <td><?= esc($participantNames) ?></td>
                    <td><?= esc($e['remarks']) ?></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $e['id'] ?>">
                                Edit
                            </button>

                            <a href="/events/delete/<?= $e['id'] ?>"
                               class="btn btn-danger btn-sm delete-btn">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="editModal<?= $e['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <form method="post" action="/events/update/<?= $e['id'] ?>">

                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title">Edit Event</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Event Date</label>
                                            <input type="text" name="event_date" value="<?= esc($e['event_date']) ?>" class="form-control mb-2">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">IIS No.</label>
                                            <input type="text" name="iis_no" value="<?= esc($e['iis_no']) ?>" class="form-control mb-2">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Special Order No.</label>
                                            <input type="text" name="special_order_no" value="<?= esc($e['special_order_no']) ?>" class="form-control mb-2">
                                        </div>
                                    </div>

                                    <label class="form-label">Learning Title</label>
                                    <textarea name="title" class="form-control mb-2"><?= esc($e['title']) ?></textarea>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Conducted By</label>
                                            <input type="text" name="conducted_by" value="<?= esc($e['conducted_by']) ?>" class="form-control mb-2">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Venue</label>
                                            <input type="text" name="venue" value="<?= esc($e['venue']) ?>" class="form-control mb-2">
                                        </div>
                                    </div>

                                    <label class="form-label">Participants</label>
                                    <select name="employee_ids[]" class="form-control mb-2" multiple>
                                        <?php foreach($employees as $emp): ?>
                                            <option value="<?= $emp['id'] ?>"
                                                <?= in_array($emp['id'], $selected_ids) ? 'selected' : '' ?>>
                                                <?= esc($emp['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <label class="form-label">Remarks / Updates</label>
                                    <textarea name="remarks" class="form-control mb-2"><?= esc($e['remarks']) ?></textarea>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" class="center-text text-muted">No events found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();

        const url = this.getAttribute('href');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                    timer: 1200,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = url;
                });
            }
        });
    });
});
</script>

<?= $this->endSection() ?>