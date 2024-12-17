<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Optical Clinic - Register</title>
  <link rel="icon" type="image/png" href="<?= base_url(); ?>public/img/favicon.ico" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
  <link href="<?= base_url(); ?>public/css/main.css" rel="stylesheet">
  <style>
  body {
    background: url('<?=base_url();?>public/assets/background.jpg') center center/cover no-repeat;
    height: 100vh;
    margin: 0;
    font-family: 'Nunito', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('<?=base_url();?>public/assets/background.jpg') center center/cover no-repeat;
    filter: blur(5px);
    z-index: -1;
  }

  .register-container {
    background: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    border-radius: 15px;
    width: 400px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    animation: fadeIn 1s ease-in-out;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: scale(0.9);
    }

    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .card-header {
    font-size: 1.8rem;
    font-weight: bold;
    color: #007bff;
    text-align: center;
    margin-bottom: 1rem;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  .btn-primary,
  .btn-secondary {
    width: 100%;
    padding: 0.75rem;
    border-radius: 5px;
    font-size: 1rem;
    margin-bottom: 1rem;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: #fff;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
  }

  .register-links {
    text-align: center;
    margin-top: 1rem;
  }

  .register-links a {
    color: #007bff;
    text-decoration: none;
    font-size: 0.9rem;
  }

  .register-links a:hover {
    color: #0056b3;
  }
  </style>
</head>

<body>
  <div class="register-container">
    <div class="card">
      <div class="card-header">Optical Clinic - Register</div>
      <div class="card-body">
        <?php flash_alert(); ?>
        <form method="POST" action="<?= site_url('auth/register'); ?>">
          <a href="<?= site_url('auth/login'); ?>" class="btn btn-secondary">Already have an account? Login</a>

          <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" class="form-control" name="username" required autofocus>
          </div>

          <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" class="form-control" name="email" required>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
          </div>

          <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
              required>
          </div>

          <button type="submit" class="btn btn-primary">Register</button>

          <div class="register-links">
            <a href="<?= site_url('auth/password-reset'); ?>">Forgot Your Password?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
  <script>
  $(function() {
    var regForm = $("#regForm");
    if (regForm.length) {
      regForm.validate({
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
            minlength: 8
          },
          password_confirmation: {
            required: true,
            minlength: 8,
            equalTo: "#password"
          },
          username: {
            required: true,
            minlength: 5,
            maxlength: 20
          }
        },
        messages: {
          email: {
            required: "Please input your email address."
          },
          password: {
            required: "Please input your password",
            minlength: "Password must be at least {0} characters."
          },
          password_confirmation: {
            required: "Please confirm your password",
            minlength: "Password must be at least {0} characters.",
            equalTo: "Password and confirmation do not match."
          },
          username: {
            required: "Please input your username."
          }
        },
      });
    }
  });
  </script>
</body>

</html>