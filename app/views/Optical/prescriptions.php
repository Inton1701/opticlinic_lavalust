<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prescriptions</title>
    <link href="<?= base_url(); ?>public/css/main.css" rel="stylesheet">
    <link href="<?= base_url(); ?>public/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include APP_DIR . 'views/templates/header.php'; ?>
    <style>
        body {
            background: url('<?= base_url(); ?>public/assets/background1.jpg') center center/cover no-repeat;
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

        h2,
        h3 {
            color: #fff;
        }

        .form-label {
            color: #fff;
        }

        .btn-primary,
        .btn-warning,
        .btn-danger {
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

        .btn-primary:active,
        .btn-warning:active,
        .btn-danger:active {
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

        .table th,
        .table td {
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

        #searchResults {
            position: absolute;
            z-index: 1000;
            max-height: 250px;
            overflow-y: auto;
            width: 100%;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        #searchResults {
            position: absolute;
            z-index: 1050;
            width: 100%;
            background-color: white;
            border: 1px solid #ccc;
            border-top: none;
            max-height: 200px;
            overflow-y: auto;
        }

        .form-group {
            position: relative;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            cursor: pointer;
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
                    <div class="form-group">
                        <label for="searchUser">Search User</label>
                        <input
                            type="text"
                            class="form-control"
                            id="searchUser"
                            placeholder="Search by name or email"
                            autocomplete="off" />
                        <input type="hidden" id="selectedUserId" name="user_id" />
                        <div
                            id="searchResults"
                            class="list-group"
                            style="position: absolute; z-index: 1000; display: none; width: 100%;"></div>
                    </div>
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
        <div class="table-responsive">
        <table class="table table-striped table-hover" id="prescriptionTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th> <!-- Changed from Patient ID to Patient Name -->
                    <th>Medication</th>
                    <th>Dosage</th>
                    <th>Duration</th>
                    <th>Checkup Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($prescriptions)): ?>
                    <?php foreach ($prescriptions as $prescription): ?>
                        <tr>
                            <td><?= $prescription['prescription_id']; ?></td>
                            <td><?= "{$prescription['first_name']} {$prescription['last_name']} "; ?></td>
                            <td><?= $prescription['medication']; ?></td>
                            <td><?= $prescription['dosage']; ?></td>
                            <td><?= $prescription['duration']; ?></td>
                            <td><?= $prescription['checkup_date']; ?></td>
                            <td>
                                <div class="btn-group">
                                <button class="btn btn-primary btn-sm" title="View Prescriptions" data-bs-toggle="modal" data-bs-target="#prescriptionModal"
                                        data-id="<?= $prescription['prescription_id']; ?>"
                                        data-patient="<?= "{$prescription['first_name']} {$prescription['last_name']}"; ?>"
                                        data-medication="<?= $prescription['medication']; ?>"
                                        data-dosage="<?= $prescription['dosage']; ?>"
                                        data-duration="<?= $prescription['duration']; ?>"
                                        data-checkup-date="<?= $prescription['checkup_date']; ?>">
                                        <i class="fas fa-prescription-bottle-alt"></i> Prescriptions
                                    </button>

                                    <!-- Edit Prescription Button -->
                                    <button class="btn btn-warning btn-sm" title="Edit Prescription" data-bs-toggle="modal" data-bs-target="#editPrescriptionModal"
                                        data-id="<?= $prescription['prescription_id']; ?>"
                                        data-patient="<?= "{$prescription['first_name']} {$prescription['last_name']} "; ?>"
                                        data-medication="<?= $prescription['medication']; ?>"
                                        data-dosage="<?= $prescription['dosage']; ?>"
                                        data-duration="<?= $prescription['duration']; ?>"
                                        data-checkup-date="<?= $prescription['checkup_date']; ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <form action="<?= site_url('optical-clinic/prescriptions/delete/' . $prescription['prescription_id']); ?>" method="get" style="display:inline;" class="delete-form">
                                        <input type="hidden" name="id" >
                                        <button type="submit" class="btn btn-danger btn-sm delete-button" title="Delete Prescription" onclick="deletePrescription(event, this)">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>

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
    </div>
    <!-- View Prescription Modal -->
    <div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="prescriptionModalLabel">Prescription for <span id="prescriptionPatient"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <h1 type="text" class="form-control" name="medication" id="prescriptionPatient" ></h1>
                    <div class="form-group">
                        <label for="prescriptionDetails">Medication</label>
                        <input type="text" class="form-control" id="prescriptionMedication" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prescriptionDosage">Dosage</label>
                        <input type="text" class="form-control" id="prescriptionDosage" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prescriptionDuration">Duration</label>
                        <input type="text" class="form-control" id="prescriptionDuration" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prescriptionCheckupDate">Checkup Date</label>
                        <input type="text" class="form-control" id="prescriptionCheckupDate" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Prescription Modal -->
    <div class="modal fade" id="editPrescriptionModal" tabindex="-1" aria-labelledby="editPrescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPrescriptionModalLabel">Edit Prescription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <h1 type="text" class="form-control" name="medication" id="editPrescriptionPatient" ></h1>
                    <form action="<?= site_url('optical-clinic/prescriptions/update'); ?>" method="POST">
                        <input type="hidden" name="prescription_id" id="editPrescriptionId">
                          
                        <div class="form-group">
                            <label for="editPrescriptionMedication">Medication</label>
                            <input type="text" class="form-control" name="medication" id="editPrescriptionMedication" required>
                        </div>
                        <div class="form-group">
                            <label for="editPrescriptionDosage">Dosage</label>
                            <input type="text" class="form-control" name="dosage" id="editPrescriptionDosage" required>
                        </div>
                        <div class="form-group">
                            <label for="editPrescriptionDuration">Duration</label>
                            <input type="text" class="form-control" name="duration" id="editPrescriptionDuration" required>
                        </div>
                        <div class="form-group">
                            <label for="editPrescriptionCheckupDate">Checkup Date</label>
                            <input type="text" class="form-control" name="checkup_date" id="editPrescriptionCheckupDate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php include APP_DIR . 'views/templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function deletePrescription(event, button) {
            event.preventDefault(); // Prevent form from submitting immediately

            // Show SweetAlert2 confirmation prompt
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this prescription? This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                // If the user confirmed, submit the form
                if (result.isConfirmed) {
                    button.closest('form').submit(); // Submit the form programmatically
                }
            });
        }
        const prescriptionButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');
    prescriptionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const patient = this.getAttribute('data-patient');
            const medication = this.getAttribute('data-medication');
            const dosage = this.getAttribute('data-dosage');
            const duration = this.getAttribute('data-duration');
            const checkupDate = this.getAttribute('data-checkup-date');

            // Debugging output
            console.log('Button clicked for:', patient);  // Check if patient name is available
            console.log('Medication:', medication);
            console.log('Dosage:', dosage);

            // View Prescription Modal
            if (this.getAttribute('data-bs-target') === '#prescriptionModal') {
                document.getElementById('prescriptionPatient').textContent = patient; // Check if this sets properly
                document.getElementById('prescriptionMedication').value = medication;
                document.getElementById('prescriptionDosage').value = dosage;
                document.getElementById('prescriptionDuration').value = duration;
                document.getElementById('prescriptionCheckupDate').value = checkupDate;
            }

            // Edit Prescription Modal
            if (this.getAttribute('data-bs-target') === '#editPrescriptionModal') {
                document.getElementById('editPrescriptionId').value = id;
                document.getElementById('editPrescriptionPatient').textContent = patient; // Check if this sets properly
                document.getElementById('editPrescriptionMedication').value = medication;
                document.getElementById('editPrescriptionDosage').value = dosage;
                document.getElementById('editPrescriptionDuration').value = duration;
                document.getElementById('editPrescriptionCheckupDate').value = checkupDate;
            }
        });
    });
        $(document).ready(function() {

            $('#prescriptionTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "pageLength": 10, // Number of rows to display
                "lengthMenu": [5, 10, 25, 50], // Custom page options
                "columnDefs": [{
                    "targets": [6], // Actions column
                    "orderable": false // Disable sorting for actions column
                }]
            });




            const $searchInput = $('#searchUser');
            const $searchResults = $('#searchResults');
            const $selectedUserId = $('#selectedUserId');

            // Event listener for input change
            $searchInput.on('input', function(e) {
                const query = $.trim($(this).val()); // Trim and fetch query value

                if (query.length > 0) {
                    // AJAX request
                    $.ajax({
                        url: `<?= site_url('optical-clinic/appointments/search_user/'); ?>${encodeURIComponent(query)}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            $searchResults.empty(); // Clear existing results

                            if (response.status === 'success' && response.data.length > 0) {
                                $searchResults.show();

                                response.data.forEach(user => {
                                    const $item = $('<div>')
                                        .addClass('list-group-item list-group-item-action')
                                        .text(`${user.first_name} ${user.last_name}`) // Display name
                                        .css('cursor', 'pointer') // Add pointer cursor
                                        .on('click', function(e) {
                                            e.preventDefault(); // Prevent default behavior (no submission)
                                            e.stopPropagation();

                                            // Set input value and hidden user ID
                                            $searchInput.val(`${user.first_name} ${user.last_name}`);
                                            $selectedUserId.val(user.id);

                                            // Hide results dropdown
                                            $searchResults.hide();
                                        });

                                    $searchResults.append($item); // Append to the dropdown
                                });
                            } else {
                                // No users found message
                                $searchResults.html(`<div class="list-group-item text-danger">No users found</div>`).show();
                            }
                        },
                        error: function() {
                            console.error('Error fetching search results.');
                            $searchResults.html(`<div class="list-group-item text-danger">Error fetching data</div>`).show();
                        }
                    });
                } else {
                    $searchResults.hide(); // Hide results if query is empty
                }
            });

            // Hide dropdown if clicked outside
            $(document).on('click', function(e) {
                if (!$searchResults.is(e.target) && !$searchResults.has(e.target).length && !$searchInput.is(e.target)) {
                    $searchResults.hide();
                }
            });
        });
    </script>
</body>

</html>