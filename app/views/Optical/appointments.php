<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointments</title>


    <?php include APP_DIR . 'views/templates/header.php'; ?>
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

        h2,
        h3 {
            color: #fff;
            font-size: 28px;
        }

        .form-label {
            color: #fff;
        }

        .btn-primary,
        .btn-warning,
        .btn-danger {
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

        .table th,
        .table td {
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

        #searchResults {
            position: absolute;
            z-index: 1000;
            max-height: 250px;
            overflow-y: auto;
            width: 100%;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        #searchResults .list-group-item {
            cursor: pointer;
        }

        #searchResults .list-group-item:hover {
            background-color: #f8f9fa;
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

        <div class="mb-4 d-flex justify-content-between">
            <h3>Appointments</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">
                Add Appointment
            </button>
        </div>
        <div class="table-responsive">
        <table id="appointmentsTable" class="table table-bordered display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Fullname</th>
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
                                <td><?= $appointment['appointment_id']; ?></td>
                                <td><?= "{$appointment['first_name']} {$appointment['last_name']} "; ?></td>
                                <td><?= $appointment['date']; ?></td>
                                <td><?= $appointment['time']; ?></td>
                                <td><?= $appointment['description']; ?></td>
                                <td><?= $appointment['status']; ?></td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editAppointmentModal" data-id="<?= $appointment['appointment_id']; ?>" data-date="<?= $appointment['date']; ?>" data-time="<?= $appointment['time']; ?>" data-description="<?= $appointment['description']; ?>" data-status="<?= $appointment['status']; ?>">
                                        Edit
                                    </button> |
                                    <form action="<?= site_url('optical-clinic/appointments/delete'); ?>" method="post" style="display:inline;" class="delete-form">
                                        <input type="hidden" name="id" value="<?= $appointment['appointment_id']; ?>">
                                        <button type="submit" class="btn btn-danger delete-button">Delete</button>
                                    </form>
                                </td>
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

    <!-- Add Appointment Modal -->
    <div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAppointmentModalLabel">Add Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('optical-clinic/appointments/add'); ?>" method="POST">
               
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
                        <!-- Date -->
                        <div class="mb-3">
                            <label for="appointmentDate" class="form-label">Date</label>
                            <input type="date" name="date" id="appointmentDate" class="form-control" required>
                        </div>

                        <!-- Time -->
                        <div class="mb-3">
                            <label for="appointmentTime" class="form-label">Time</label>
                            <input type="time" name="time" id="appointmentTime" class="form-control" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="appointmentDescription" class="form-label">Description</label>
                            <textarea name="description" id="appointmentDescription" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    </div>

    <?php include APP_DIR . 'views/templates/footer.php'; ?>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
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


        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        form.submit();
                    }
                });
            });
        });


        $(document).ready(function() {

            $('#appointmentsTable').DataTable({
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
                        error: function(jqXHR, textStatus, errorThrown) {
    console.error('Error fetching search results.');
    console.error('Status:', textStatus);
    console.error('Error Thrown:', errorThrown);
    console.error('Response:', jqXHR.responseText); // Logs the server response

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