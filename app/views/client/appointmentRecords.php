<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment List</title>
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(120deg, #f0f7ff, #d4e5ff);
    color: #333;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

  }


  h4 {
    color: #003366;
    text-align: center;
    font-size: 1.5rem;
    margin: 2vh 0;
    letter-spacing: 2px;
    text-shadow: 1px 1px 2px #ccd9ff;
  }

  .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
    padding: 10px;
    flex: 1;
    align-items: flex-start;
    /* Add this line */
    overflow: hidden;
  }


  #calendar {
    flex: 1 1 48%;
    min-width: 300px;
    max-height: 70vh;
    /* Adjust the calendar height */
    overflow-y: auto;
    margin-top: 10px;
    /* Add spacing */
  }

  table {
    width: 48%;
    border-collapse: collapse;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-height: 70vh;
    /* Adjust table height */
    overflow-y: auto;
    margin-top: 10px;
    /* Add spacing */
  }


  th,
  td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #d9e6ff;
  }

  th {
    background-color: #003366;
    color: #ffffff;
    font-size: 1.1rem;
    text-transform: uppercase;
  }

  tr:nth-child(even) {
    background-color: #f0f7ff;
  }

  tr:hover {
    background-color: #cde0ff;
    transition: background-color 0.3s ease;
  }

  .status-completed {
    color: #28a745;
    font-weight: bold;
  }

  .status-pending {
    color: #ffc107;
    font-weight: bold;
  }

  .status-cancelled {
    color: #dc3545;
    font-weight: bold;
  }


  .filter-container {
    text-align: center;
    margin: 20px 0;
  }

  .filter-container select {
    padding: 8px;
    margin: 5px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ddd;
  }

  .cancel-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .cancel-btn:disabled {
    background-color: #f8d7da;
    color: #6c757d;
    cursor: not-allowed;
  }

  .cancel-btn:hover {
    background-color: #c82333;
  }
  </style>
</head>

<body>
  <?php
  include APP_DIR . 'views/templates/clientNav.php';
  ?>

  <h4>Your Recent Appointments</h4>

  <!-- Filters Section -->
  <div class="filter-container">
    <form method="GET" action="" id="appointment-filter">
      <select name="status" id="status">
        <option value="">Select Status</option>
        <option value="completed">Completed</option>
        <option value="pending">Pending</option>
        <option value="cancelled">Cancelled</option>
      </select>
      <button type="submit"
        style="background-color: #003366; color: white; padding: 10px 15px; border: none; border-radius: 5px;">Filter</button>
    </form>
  </div>

  <!-- Appointment List -->
  <div class="container">
    <table id="appointments-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th>Description</th>
          <th>Status</th>
          <th>Appointed At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($appointments as $a) : ?>
        <tr data-date="<?= $a['date'] ?>" class="appointment-row">
          <td><?= $a['date'] ?></td>
          <td><?= date('h:i A', strtotime($a['time'])) ?></td>
          <td><?= $a['description'] ?></td>
          <td class="status-<?= strtolower($a['status']) ?>"><?= ucfirst($a['status']) ?></td>
          <td><?= $a['created_at'] ?></td>
          <td>
            <form method="post" action="/cancel/appointment/" class="cancel-form">
              <input type="hidden" name="id" value="<?= $a['id'] ?>">
              <button type="button" class="cancel-btn" data-id="<?= $a['id'] ?>"
                <?= $a['status'] !== 'Pending' ? 'disabled' : '' ?>>
                Cancel
              </button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div id="calendar"></div>
  </div>

  <script>
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      events: function(start, end, timezone, callback) {
        var events = [];
        <?php foreach ($appointments as $a) : ?>
        events.push({
          title: '<?= $a['description'] ?>',
          start: '<?= $a['date'] ?>T<?= $a['time'] ?>',
          status: '<?= $a['status'] ?>',
        });
        <?php endforeach; ?>
        callback(events);
      },
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
    });

    $(".cancel-btn").off("click").on("click", function() {
      const form = $(this).closest('.cancel-form');
      const appointmentId = $(this).data("id");

      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to cancel this appointment?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Yes, cancel it!",
        cancelButtonText: "No, keep it"
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });

    $("#appointment-filter").on("submit", function(event) {
      event.preventDefault();
      const status = $("#status").val().toLowerCase();

      $("#appointments-table tbody tr").each(function() {
        const rowStatus = $(this).find("td:nth-child(4)").text().toLowerCase();
        $(this).toggle(status === "" || rowStatus === status);
      });
    });
  });
  </script>
</body>

</html>