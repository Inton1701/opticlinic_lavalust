<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Prescription</title>
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
            transition: background-color 0.3s, transform 0.2s;
        }
        .back-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .back-button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.7);
        }

        .container {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 8px;
            margin-top: 30px;
        }

        h2, h3 {
            color: #fff;
        }

        .form-label {
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.7);
        }

        .btn-warning, .btn-danger {
            margin-top: 5px;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-warning {
            background-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .btn-warning:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(255, 193, 7, 0.7);
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .btn-danger:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.7);
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.location.href='<?= site_url('optical-clinic/prescriptions'); ?>'">
            Back
        </button>
        
        <h2>Edit Prescription</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <form action="<?= site_url('optical-clinic/prescriptions/update/'.$prescription['id']); ?>" method="POST">
            <div class="mb-3">
                <label for="medication" class="form-label">Medication</label>
                <input type="text" name="medication" id="medication" class="form-control" value="<?= $prescription['medication']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="dosage" class="form-label">Dosage</label>
                <input type="text" name="dosage" id="dosage" class="form-control" value="<?= $prescription['dosage']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" name="duration" id="duration" class="form-control" value="<?= $prescription['duration']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="renewal_date" class="form-label">Renewal Date</label>
                <input type="date" name="renewal_date" id="renewal_date" class="form-control" value="<?= $prescription['renewal_date']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Prescription</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
