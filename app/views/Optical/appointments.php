<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointments</title>
    <link href="<?= base_url(); ?>public/css/main.css" rel="stylesheet">
    <link href="<?= base_url(); ?>public/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('<?= base_url(); ?>public/assets/background1.jpg') center center/cover no-repeat;
            color: #fff;
        }

        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .back-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
        }

        h2, h3 {
            color: #fff;
            font-size: 28px;
        }

        .form-label {
            color: #fff;
        }

        .btn-primary, .btn-warning, .btn-danger {
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .table {
            color: #fff;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #fff;
        }

        .table thead {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .table tbody tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.4);
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }

        .modal-content {
            position: relative;
            background-image: url('<?= base_url(); ?>public/assets/app.jpg');
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .modal-header {
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
        }

        .modal-body {
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .modal-footer {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-footer .btn {
            padding: 8px 16px;
            border-radius: 6px;
        }

        .modal-footer .btn-primary {
            background-color: #007bff;
        }

        .modal-footer .btn-danger {
            background-color: #dc3545;
        }

        .modal-footer .btn-primary:hover {
            background-color: #0056b3;
        }

        .modal-footer .btn-danger:hover {
            background-color: #c82333;
        }

        .modal-backdrop {
            backdrop-filter: blur(5px);
        }

    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.location.href='<?= site_url('home'); ?>'">
            Back to Home
        </button>

        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <h3>Appointment</h3>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($appointments)): ?>
                        <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <td><?= $appointment['id']; ?></td>
                                <td><?= $appointment['date']; ?></td>
                                <td><?= $appointment['time']; ?></td>
                                <td><?= $appointment['description']; ?></td>
                                <td><?= $appointment['status']; ?></td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editAppointmentModal" data-id="<?= $appointment['id']; ?>" data-date="<?= $appointment['date']; ?>" data-time="<?= $appointment['time']; ?>" data-description="<?= $appointment['description']; ?>" data-status="<?= $appointment['status']; ?>">
                                        Edit
                                    </button> |
                                    <form action="<?= site_url('optical-clinic/appointments/delete'); ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $appointment['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No appointments found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="editAppointmentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAppointmentModalLabel">Edit Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= site_url('optical-clinic/appointments/update'); ?>" method="POST">
                            <input type="hidden" name="id" id="appointmentId">
                            <div class="mb-3">
                                <label for="editDate" class="form-label">Date</label>
                                <input type="date" name="date" id="editDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editTime" class="form-label">Time</label>
                                <input type="time" name="time" id="editTime" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDescription" class="form-label">Description</label>
                                <textarea name="description" id="editDescription" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editStatus" class="form-label">Status</label>
                                <select name="status" id="editStatus" class="form-control" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const date = this.getAttribute('data-date');
                const time = this.getAttribute('data-time');
                const description = this.getAttribute('data-description');
                const status = this.getAttribute('data-status');
                
                document.getElementById('appointmentId').value = id;
                document.getElementById('editDate').value = date;
                document.getElementById('editTime').value = time;
                document.getElementById('editDescription').value = description;
                document.getElementById('editStatus').value = status;
            });
        });
    </script>
</body>
</html>
