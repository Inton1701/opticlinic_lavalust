<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optical Clinic Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <?php include APP_DIR . 'views/templates/header.php'; ?>
    <style>
        body {
            background: url('<?=base_url();?>public/assets/background1.jpg') center center/cover no-repeat;
            height: 100vh;
            margin: 0;
            font-family: 'Nunito', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .container-fluid {
            position: relative;
            z-index: 1;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s ease, box-shadow 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn i {
            margin-right: 8px;
        }

        .logout-btn:hover {
            background-color: #c82333;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.5);
        }

        .logout-btn:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.7);
        }

        .logout-btn:active {
            transform: scale(0.98);
        }

        .title-section h1 {
            font-weight: 700;
            font-size: 2.5rem;
            color: #333;
            animation: fadeInTitle 1s ease-out;
        }

        @keyframes fadeInTitle {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-body {
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
        }

        .card-body:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-weight: 600;
            color: #333;
        }

        .card-subtitle {
            color: #666;
        }

        .card-icon {
            font-size: 3rem;
            color: #007bff;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .quick-actions .btn {
            transition: transform 0.3s ease, background-color 0.3s ease;
            font-size: 1.1rem;
            padding: 12px 18px;
            margin: 10px 0;
            width: 100%;
        }

        .quick-actions .btn:hover {
            transform: scale(1.05);
            background-color: #0056b3;
        }

        .badge {
            font-size: 1.2rem;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 2rem;
            animation: fadeIn 1s ease-out;
        }

        table th,
        table td {
            padding: 1rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .logout-btn {
                top: 10px;
                right: 10px;
            }

            .quick-actions .btn {
                width: 100%;
                margin-bottom: 1rem;
            }

            .card-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid p-4">
        <a href="<?= site_url('optical-clinic/logout'); ?>" class="btn logout-btn">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <div class="title-section text-center mb-4">
            <h1>Optical Clinic Admin Dashboard</h1>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-custom mb-4">
                    <div class="card-body text-center dash-counts" >
                        <i class="bi bi-calendar-event card-icon text-primary mb-3"></i>
                        <h5 class="card-title">Appointments</h5>
                        <p class="fs-4 mb-1">0</p>
                        <small class="card-subtitle">Scheduled this week</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-custom mb-4 dash-counts">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-text card-icon text-success mb-3"></i>
                        <h5 class="card-title">Prescriptions</h5>
                        <p class="fs-4 mb-1">0</p>
                        <small class="card-subtitle">Issued this month</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-custom mb-4 ">
                    <div class="card-body text-center">
                        <i class="bi bi-eyeglasses card-icon text-warning mb-3"></i>
                        <h5 class="card-title">Frames in Stock</h5>
                        <p class="fs-4 mb-1">0</p>
                        <small class="card-subtitle">Available inventory</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-custom mb-4 dash-counts">
                    <div class="card-body text-center">
                        <i class="bi bi-people card-icon text-danger mb-3"></i>
                        <h5 class="card-title">Active Patients</h5>
                        <p class="fs-4 mb-1">0</p>
                        <small class="card-subtitle">Registered in the system</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card shadow-custom mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Quick Actions</h5>
                        <div class="d-flex justify-content-between flex-wrap quick-actions">
                            <a href="<?= site_url('optical-clinic/appointments'); ?>" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> New Appointment
                            </a>
                            <a href="<?= site_url('optical-clinic/prescriptions'); ?>" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> New Prescription
                            </a>
                            <a href="<?= site_url('optical-clinic/frames'); ?>" class="btn btn-warning">
                                <i class="bi bi-plus-circle"></i> Add Frames
                            </a>
                            <a href="<?= site_url('optical-clinic/patient'); ?>" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> Add Patient
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-custom mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Patient Check-ins</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Appointment Time</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php if (!empty($appointments)): ?>
                        <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <td><?= "{$appointment['first_name']} {$appointment['last_name']} "; ?></td>
       
                                <td><?= "{$appointment['date']}  {$appointment['time']}" ?></td>
              
                                <td><?= $appointment['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No appointments found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include APP_DIR . 'views/templates/footer.php'; ?>
    <script>
        function loadDashboard() {
    $.ajax({
        url: '<?= site_url('home/fetch_dashboard_data') ?>',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                const data = response.data;

                // Dynamically update counts using response data
                $('.dash-counts:contains("Appointments") p').text(data.appointments.total_appointments.total_appointments || 0);
                $('.dash-counts:contains("Active Patients") p').text(data.users.total_users.total_users || 0);
                $('.dash-counts:contains("Prescriptions") p').text(data.prescriptions.total_prescriptions.total_prescriptions || 0);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
            Swal.fire('Error', 'An error occurred while fetching dashboard data', 'error');
        },
    });
}
$(document).ready(function () {
    loadDashboard();
});

    </script>
</body>

</html>
