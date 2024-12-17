<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment Booking</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #a7c5f2, #b3e0ff), url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22 width=%22100%22 height=%22100%22%3E%3Ccircle cx=%2250%22 cy=%2250%22 r=%2210%22 fill=%22%23FFFFFF%22 opacity=%220.2%22/%3E%3Ccircle cx=%2220%22 cy=%2220%22 r=%2210%22 fill=%22%23FFFFFF%22 opacity=%220.2%22/%3E%3Ccircle cx=%2275%22 cy=%2275%22 r=%2210%22 fill=%22%23FFFFFF%22 opacity=%220.2%22/%3E%3Ccircle cx=%2245%22 cy=%2235%22 r=%2210%22 fill=%22%23FFFFFF%22 opacity=%220.2%22/%3E%3C/svg%3E'),
      url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Cpath d=%22M10,40 Q 25,30 40,40 T 70,40 T 90,40%22 fill=%22transparent%22 stroke=%22%23FFFFFF%22 stroke-width=%222%22/%3E%3Cpath d=%22M30,40 Q 30,30 50,30 T 70,40%22 fill=%22transparent%22 stroke=%22%23FFFFFF%22 stroke-width=%222%22/%3E%3C/svg%3E');
    background-repeat: repeat;
    color: #333;
  }

  .container {
    max-width: 450px;
    margin: 10vh auto;
    background: #fff;
    padding: 25px 35px;
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    /* Slightly stronger shadow for contrast */
    text-align: center;
  }

  h2 {
    font-size: 1.3rem;
    margin-bottom: 25px;
    color: #333;
    font-weight: 600;
    letter-spacing: 2px;
  }

  label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
    font-size: 0.95rem;
  }

  input,
  select,
  textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }

  input[type="submit"] {
    background-color: #2575fc;
    color: white;
    border: none;
    cursor: pointer;
    padding: 12px 20px;
    font-size: 1.1rem;
    border-radius: 6px;
    transition: background-color 0.3s ease;
  }

  input[type="submit"]:hover {
    background-color: #6a11cb;
  }

  textarea {
    resize: none;
    height: 100px;
    font-family: 'Arial', sans-serif;
  }

  .note {
    font-size: 0.9rem;
    color: #888;
    margin-top: 10px;
  }

  .form-group {
    margin-bottom: 25px;
  }

  /* Button Focus Style */
  input[type="submit"]:focus {
    outline: none;
    box-shadow: 0 0 5px 2px rgba(37, 117, 252, 0.5);
  }

  /* Input and textarea focus style */
  input:focus,
  textarea:focus {
    border-color: #2575fc;
  }
  </style>
</head>

<body>
  <?php 
    include APP_DIR . 'views/templates/clientNav.php';
    flash_alert(); 
  ?>
  <div class="container">
    <h2>Book an Appointment</h2>
    <form action="/client/appoint" method="POST">
      <div class="form-group">
        <label for="date">Preferred Date</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="time">Preferred Time</label>
        <input type="time" id="time" name="time" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Provide additional details"></textarea>
      </div>
      <input type="submit" value="Book Appointment">
      <p class="note">Note: Ensure the date and time are accurate for your preferred appointment.</p>
    </form>
  </div>
</body>

</html>