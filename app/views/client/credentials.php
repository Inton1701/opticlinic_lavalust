<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <style>
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #6dd5ed, #2193b0);
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  main {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-grow: 1;
    margin-top: 80px;
  }

  form {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 900px;
  }

  h1 {
    text-align: center;
    color: #333;
    font-size: 1.8rem;
    margin-bottom: 20px;
  }

  .form-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  .form-control {
    flex: 1 1 calc(50% - 20px);
    display: flex;
    flex-direction: column;
  }

  label {
    margin-bottom: 8px;
    color: #333;
    font-weight: bold;
  }

  input,
  select,
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.95rem;
    color: #333;
    transition: border-color 0.3s, box-shadow 0.3s;
  }

  input:focus,
  select:focus,
  textarea:focus {
    border-color: #2193b0;
    outline: none;
    box-shadow: 0 0 6px rgba(33, 147, 176, 0.4);
  }

  button {
    display: block;
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 6px;
    background-color: #2193b0;
    color: #fff;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    text-transform: uppercase;
    transition: background-color 0.3s, box-shadow 0.3s;
    margin-top: 20px;
  }

  button:hover {
    background-color: #176682;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  }

  @media (max-width: 768px) {
    .form-control {
      flex: 1 1 100%;
    }
  }
  </style>
</head>

<body>
  <!-- Navigation -->
  <?php 
    include APP_DIR . 'views/templates/clientNav.php';
    flash_alert(); 
  ?>

  <main>
    <!-- Registration Form -->
    <form action="/client/update-credential" method="POST">
      <h1>Complete Your Information</h1>
      <div class="form-container">
        <div class="form-control">
          <label for="fName">First Name</label>
          <input type="text" id="fName" name="fName" value="<?php echo htmlspecialchars($credentials['first_name']); ?>"
            required>
        </div>

        <div class="form-control">
          <label for="lName">Last Name</label>
          <input type="text" id="lName" name="lName" value="<?php echo htmlspecialchars($credentials['last_name']); ?>"
            required>
        </div>

        <div class="form-control">
          <label for="dob">Date of Birth</label>
          <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($credentials['dob']); ?>" required>
        </div>

        <div class="form-control">
          <label for="gender">Gender</label>
          <select id="gender" name="gender" required>
            <option value="male" <?php echo ($credentials['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($credentials['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
            <option value="other" <?php echo ($credentials['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
          </select>
        </div>

        <div class="form-control">
          <label for="number">Contact Number</label>
          <input type="tel" id="number" name="number"
            value="<?php echo htmlspecialchars($credentials['contact_number']); ?>" required>
        </div>

        <div class="form-control">
          <label for="address">Address</label>
          <textarea id="address" name="address" rows="1"
            required><?php echo htmlspecialchars($credentials['address']); ?></textarea>
        </div>
      </div>

      <button type="submit">Update Credentials</button>
    </form>
  </main>
</body>

</html>