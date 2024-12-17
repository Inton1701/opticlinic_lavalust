<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prescriptions</title>
    <link href="<?= base_url(); ?>public/css/main.css" rel="stylesheet">
    <link href="<?= base_url(); ?>public/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('<?=base_url();?>public/assets/background1.jpg') center center/cover no-repeat;
            background-size: cover;
            background-position: center;
            color: #fff;
        }

        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.2s ease, box-shadow 0.2s;
        }
        .back-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.5);
        }
        .back-button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.7);
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 8px;
        }

        h2, h3 {
            color: #fff;
        }

        .form-label {
            color: #fff;
        }

        .btn-primary, .btn-warning, .btn-danger {
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.2s ease, box-shadow 0.2s;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.5);
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.7);
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.5);
        }

        .btn-warning:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(255, 193, 7, 0.7);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.5);
        }

        .btn-danger:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.7);
        }

        .btn-primary:active, .btn-warning:active, .btn-danger:active {
            transform: scale(0.98);
        }

        .form-control {
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.7);
        }

        .table {
            color: #fff;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #fff;
            color: #fff !important;
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

    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.location.href='<?= site_url('home'); ?>'">
            Back to Home
        </button>
        <h2>Prescriptions</h2>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="mb-4">
            <form action="<?= site_url('optical-clinic/prescriptions/create'); ?>" method="POST">
                <div class="mb-3">
                    <label for="patient_id" class="form-label">Patient Name</label>
                    <input type="text" name="patient_id" id="patient_id" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="medication" class="form-label">Medication</label>
                    <input type="text" name="medication" id="medication" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="dosage" class="form-label">Dosage</label>
                    <input type="text" name="dosage" id="dosage" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" name="duration" id="duration" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="renewal_date" class="form-label">Renewal Date</label>
                    <input type="date" name="renewal_date" id="renewal_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Prescription</button>
            </form>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th> <!-- Changed from Patient ID to Patient Name -->
                    <th>Medication</th>
                    <th>Dosage</th>
                    <th>Duration</th>
                    <th>Renewal Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($prescriptions)): ?>
                    <?php foreach ($prescriptions as $prescription): ?>
                        <tr>
                            <td><?= $prescription['id']; ?></td>
                            <td><?= $prescription['patient_first_name']; ?></td> <!-- Displaying Patient's First Name -->
                            <td><?= $prescription['medication']; ?></td>
                            <td><?= $prescription['dosage']; ?></td>
                            <td><?= $prescription['duration']; ?></td>
                            <td><?= $prescription['renewal_date']; ?></td>
                            <td>
                                <a href="<?= site_url('optical-clinic/prescriptions/edit/'.$prescription['id']); ?>" class="btn btn-warning btn-sm">Edit</a> |
                                <a href="<?= site_url('optical-clinic/prescriptions/delete/'.$prescription['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No prescriptions found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
