<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patients</title>
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
            <h3>Create New Patient</h3>
            <form action="<?= site_url('optical-clinic/patient/create'); ?>" method="POST">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="contact_number" class="form-label">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Patient</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($patients)): ?>
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td><?= $patient['id']; ?></td>
                                <td><?= $patient['first_name']; ?></td>
                                <td><?= $patient['last_name']; ?></td>
                                <td><?= $patient['dob']; ?></td>
                                <td><?= $patient['gender']; ?></td>
                                <td><?= $patient['contact_number']; ?></td>
                                <td><?= $patient['email']; ?></td>
                                <td><?= $patient['address']; ?></td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPatientModal" data-id="<?= $patient['id']; ?>" data-first_name="<?= $patient['first_name']; ?>" data-last_name="<?= $patient['last_name']; ?>" data-dob="<?= $patient['dob']; ?>" data-gender="<?= $patient['gender']; ?>" data-contact_number="<?= $patient['contact_number']; ?>" data-email="<?= $patient['email']; ?>" data-address="<?= $patient['address']; ?>">
                                        Edit
                                    </button> |
                                    <form action="<?= site_url('optical-clinic/patient/delete'); ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $patient['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No patients found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPatientModalLabel">Edit Patient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= site_url('optical-clinic/patient/update'); ?>" method="POST">
                            <input type="hidden" name="id" id="patientId">
                            <div class="mb-3">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input type="text" name="first_name" id="editFirstName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input type="text" name="last_name" id="editLastName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDob" class="form-label">Date of Birth</label>
                                <input type="date" name="dob" id="editDob" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editGender" class="form-label">Gender</label>
                                <select name="gender" id="editGender" class="form-control" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editContactNumber" class="form-label">Contact Number</label>
                                <input type="text" name="contact_number" id="editContactNumber" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" name="email" id="editEmail" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editAddress" class="form-label">Address</label>
                                <textarea name="address" id="editAddress" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Patient</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS & Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
        
        <script>
            var editPatientModal = document.getElementById('editPatientModal');
            editPatientModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var firstName = button.getAttribute('data-first_name');
                var lastName = button.getAttribute('data-last_name');
                var dob = button.getAttribute('data-dob');
                var gender = button.getAttribute('data-gender');
                var contactNumber = button.getAttribute('data-contact_number');
                var email = button.getAttribute('data-email');
                var address = button.getAttribute('data-address');

                var modalTitle = editPatientModal.querySelector('.modal-title');
                modalTitle.textContent = 'Edit Patient - ' + firstName + ' ' + lastName;

                var patientId = editPatientModal.querySelector('#patientId');
                patientId.value = id;

                var editFirstName = editPatientModal.querySelector('#editFirstName');
                editFirstName.value = firstName;

                var editLastName = editPatientModal.querySelector('#editLastName');
                editLastName.value = lastName;

                var editDob = editPatientModal.querySelector('#editDob');
                editDob.value = dob;

                var editGender = editPatientModal.querySelector('#editGender');
                editGender.value = gender;

                var editContactNumber = editPatientModal.querySelector('#editContactNumber');
                editContactNumber.value = contactNumber;

                var editEmail = editPatientModal.querySelector('#editEmail');
                editEmail.value = email;

                var editAddress = editPatientModal.querySelector('#editAddress');
                editAddress.value = address;
            });
        </script>
    </div>
</body>
</html>
