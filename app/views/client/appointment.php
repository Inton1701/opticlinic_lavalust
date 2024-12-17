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
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #333;
  }

  .container {
    max-width: 400px;
    margin: 50px auto;
    background: #fff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
  }

  input,
  select,
  textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
  }

  input[type="submit"] {
    background-color: #2575fc;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  input[type="submit"]:hover {
    background-color: #6a11cb;
  }

  textarea {
    resize: none;
    height: 80px;
  }

  .note {
    font-size: 12px;
    color: #999;
  }
  </style>
</head>

<body>
  <div class="container">
    <h2>Book an Appointment</h2>
    <form action="#" method="POST">
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your full name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

      <label for="date">Preferred Date</label>
      <input type="date" id="date" name="date" required>

      <label for="time">Preferred Time</label>
      <input type="time" id="time" name="time" required>

      <label for="message">Additional Notes</label>
      <textarea id="message" name="message" placeholder="Enter any additional notes"></textarea>

      <input type="submit" value="Book Appointment">
      <p class="note">We will confirm your appointment via email or phone.</p>
    </form>
  </div>
</body>

</html>