<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prescription List</title>
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(120deg, #f0f7ff, #d4e5ff);
    color: #333;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  h4 {
    color: #003366;
    text-align: center;
    margin: 20px 0;
    font-size: 1.8rem;
    letter-spacing: 1px;
  }

  .container {
    display: flex;
    flex-direction: column;
    padding: 10px 5%;
  }

  /* Filter and Sorting Section */
  .filter {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;

  }

  .filter-container input,
  .sort-container select {
    padding: 10px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ddd;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
  }

  .filter-container input:focus,
  .sort-container select:focus {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    outline: none;
  }

  .filter-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    margin-right: 20px;
  }

  .sort-container {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    /* Aligns the label and dropdown to the right */
    gap: 5px;
    padding-left: 60vw;
    /* Adds spacing between the label and dropdown */
  }

  .sort-container label {
    font-size: 1rem;
    color: #333;
    font-weight: 600;
    /* Makes the label slightly bold */
    margin-bottom: 5px;
  }


  table {
    width: 90%;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  table th,
  table td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
  }

  table th {
    background-color: #003366;
    color: white;
    text-transform: uppercase;
  }

  table tbody tr:nth-child(even) {
    background-color: #f0f7ff;
  }

  table tbody tr:hover {
    background-color: #cde0ff;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .container {
      flex-direction: column;
      align-items: center;
    }

    .filter {
      flex-direction: column;
      gap: 10px;
    }

    table {
      width: 100%;
    }

    .sort-container {
      justify-content: center;
    }
  }
  </style>
</head>

<body>
  <?php include APP_DIR . 'views/templates/clientNav.php'; ?>

  <h4>Your Recent Prescriptions</h4>

  <!-- Prescription Filters and Sort Options -->
  <div class="container">
    <div class="filter">
      <!-- Filter Input -->
      <div class="filter-container">
        <label for="medication-search">Search Medication:</label>
        <input type="text" id="medication-search" placeholder="Enter medication name" />
      </div>

      <!-- Sorting Dropdown -->
      <div class="sort-container">
        <label for="sort-dropdown">Sort by Created At:</label>
        <select id="sort-dropdown">
          <option value="desc">Descending</option>
          <option value="asc">Ascending</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Prescription List Table -->
  <table id="prescriptions-table">
    <thead>
      <tr>
        <th>Medication</th>
        <th>Dosage</th>
        <th>Duration</th>
        <th>Renewal Date</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($prescriptions as $p) : ?>
      <tr class="prescription-row">
        <td><?= htmlspecialchars($p['medication']) ?></td>
        <td><?= htmlspecialchars($p['dosage']) ?></td>
        <td><?= htmlspecialchars($p['duration']) ?></td>
        <td><?= htmlspecialchars($p['renewal_date']) ?></td>
        <td><?= htmlspecialchars($p['created_at']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script>
  $(document).ready(function() {
    // Debounce function to enhance search filtering performance
    function debounce(func, delay) {
      let timeout;
      return function() {
        clearTimeout(timeout);
        timeout = setTimeout(func, delay);
      };
    }

    // Filter Functionality
    const filterMedications = debounce(function() {
      const searchTerm = $("#medication-search").val().toLowerCase();
      $("#prescriptions-table tbody tr").each(function() {
        const medication = $(this).find("td:first").text().toLowerCase();
        $(this).toggle(medication.includes(searchTerm));
      });
    }, 300);

    $("#medication-search").on("input", filterMedications);

    // Sorting Functionality
    $("#sort-dropdown").on("change", function() {
      const order = $(this).val();
      const rows = $("#prescriptions-table tbody tr").get();

      rows.sort(function(a, b) {
        const dateA = new Date($(a).find("td:last").text());
        const dateB = new Date($(b).find("td:last").text());

        return order === "asc" ? dateA - dateB : dateB - dateA;
      });

      $("#prescriptions-table tbody").empty().append(rows);
    });
  });
  </script>
</body>

</html>