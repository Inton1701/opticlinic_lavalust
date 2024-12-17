<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <!-- Navigation Header -->
  <header class="nav-header">
    <div class="logo">
      <a href="#"><i class="fa-solid fa-glasses" style="padding-right: 2vw;"></i>Optic</a>
    </div>
    <nav>
      <ul class="nav-links">
        <li><a href="/client/appointment">Appointment</a></li>
        <li><a href="/client/credentials">Manage Credentials</a></li>
        <li><a href="/client/records">Appointment Records</a></li>
        <li><a href="/client/prescriptions">Prescriptions</a></li>
        <li><a href="<?= site_url('optical-clinic/logout'); ?>" class="logout-btn btn">Logout</a></li>
      </ul>
    </nav>
  </header>
</body>
<style>
/* Reset Default Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  background-color: #f8f9fa;
  color: #333;
}

/* Navigation Header Styling */
.nav-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 50px;
  background-color: #ffffff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 1000;
}

/* Logo */
.logo a {
  font-size: 1.8rem;
  font-weight: bold;
  color: #333;
  text-decoration: none;
  letter-spacing: 2px;
}

/* Navigation Links */
.nav-links {
  list-style: none;
  display: flex;
  gap: 30px;
}

.nav-links a {
  text-decoration: none;
  color: #333;
  font-size: 1rem;
  font-weight: 500;
  position: relative;
  transition: color 0.3s ease;
}

/* Hover Effect */
.nav-links a::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0;
  height: 2px;
  background-color: #6c63ff;
  /* Aesthetic underline color */
  transition: width 0.3s ease;
}

.nav-links a:hover::after {
  width: 100%;
}

.nav-links a:hover {
  color: #6c63ff;
  /* Change text color on hover */
}

/* Logout Button Styling */
.logout-btn {
  color: #ff4b5c !important;
  font-weight: bold !important;
}

.logout-btn::after {
  background-color: #ff4b5c !important;
}
</style>

</html>