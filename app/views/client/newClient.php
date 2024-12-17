<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  form {
    background: #ffffff;
    padding: 20px 40px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
  }

  h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
  }

  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
  }

  input,
  select,
  textarea,
  button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
  }

  input:focus,
  select:focus,
  textarea:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
  }

  textarea {
    resize: none;
  }

  button {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
  }

  button:hover {
    background-color: #0056b3;
  }
  </style>
</head>

<body>
  <form>
    <h1>Please fill in the additional information before proceeding.</h1>
    <input type="hidden" name="id" value="<?php  ?>">
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" value="" required>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" value="" required>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" value="" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
      <option value="male" selected>Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select>

    <label for="contact">Contact Number:</label>
    <input type="tel" id="contact" name="contact" value="" required>

    <label for="address">Address:</label>
    <textarea id="address" name="address" rows="3" required></textarea>

    <button type="submit">Register</button>
  </form>
</body>

</html>