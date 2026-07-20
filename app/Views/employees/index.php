<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Employees</h2>

    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
        <i class="fa-solid fa-plus"></i> Add Employee
    </button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="row mb-3">
            <div class="col-md-5">
                <input type="text" id="employeeSearch" class="form-control"
                       placeholder="Search by name, code, position, type...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="employeeTable">
                <thead class="table-light">
                    <tr>
                        <th>Employee Code</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Type</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($employees as $emp): ?>
                        <tr>
                            <td><?= esc($emp['employee_code']) ?></td>
                            <td class="fw-semibold"><?= esc($emp['name']) ?></td>
                            <td><?= esc($emp['position']) ?></td>
                            <td>
                                <?php if ($emp['employment_type'] === 'Permanent'): ?>
                                    <span class="badge bg-success">Permanent</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">COS</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/employees/<?= $emp['id'] ?>/trainings"
                                   class="btn btn-sm btn-info text-white">
                                    <i class="fa fa-clock"></i> History
                                </a>

                                <button class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editEmployeeModal<?= $emp['id'] ?>">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <a href="/employees/delete/<?= $emp['id'] ?>"
                                   onclick="return confirm('Delete this employee?')"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- EDIT EMPLOYEE MODAL -->
                        <div class="modal fade" id="editEmployeeModal<?= $emp['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title">Edit Employee</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <form method="post" action="/employees/update/<?= $emp['id'] ?>">
                                        <?= csrf_field() ?>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label">Employee Code</label>
                                                <input type="text" name="employee_code"
                                                       value="<?= esc($emp['employee_code']) ?>"
                                                       class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name"
                                                       value="<?= esc($emp['name']) ?>"
                                                       class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Position</label>
                                                <input type="text" name="position"
                                                       value="<?= esc($emp['position']) ?>"
                                                       class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Employment Type</label>
                                                <select name="employment_type" class="form-control" required>
                                                    <option value="Permanent" <?= $emp['employment_type'] === 'Permanent' ? 'selected' : '' ?>>
                                                        Permanent
                                                    </option>
                                                    <option value="COS" <?= $emp['employment_type'] === 'COS' ? 'selected' : '' ?>>
                                                        COS
                                                    </option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-warning">
                                                Update Employee
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination justify-content-end mt-3" id="pagination"></ul>
        </nav>

    </div>
</div>

<!-- ADD EMPLOYEE MODAL -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Employee</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" action="/employees/store">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Employee Code</label>
                        <input type="text" name="employee_code" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Employment Type</label>
                        <select name="employment_type" class="form-control" required>
                            <option value="">Select Employment Type</option>
                            <option value="Permanent">Permanent</option>
                            <option value="COS">COS</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        Save Employee
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('employeeSearch');
    const table = document.getElementById('employeeTable');
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    const pagination = document.getElementById('pagination');

    let currentPage = 1;
    const rowsPerPage = 5;

    function getFilteredRows() {
        const keyword = searchInput.value.toLowerCase();

        return rows.filter(row => {
            return row.innerText.toLowerCase().includes(keyword);
        });
    }

    function renderTable() {
        const filteredRows = getFilteredRows();
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

        rows.forEach(row => row.style.display = 'none');

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        filteredRows.slice(start, end).forEach(row => {
            row.style.display = '';
        });

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        pagination.innerHTML = '';

        if (totalPages <= 1) return;

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = 'page-item ' + (i === currentPage ? 'active' : '');

            const button = document.createElement('button');
            button.className = 'page-link';
            button.textContent = i;

            button.addEventListener('click', function () {
                currentPage = i;
                renderTable();
            });

            li.appendChild(button);
            pagination.appendChild(li);
        }
    }

    searchInput.addEventListener('keyup', function () {
        currentPage = 1;
        renderTable();
    });

    renderTable();
});
</script>

<?= $this->endSection() ?>