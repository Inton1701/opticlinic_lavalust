<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Optical Clinic - Reset Password</title>
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
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

        .reset-container {
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

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            border-radius: 5px;
            font-size: 1rem;
            margin-bottom: 1rem;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .reset-links {
            text-align: center;
            margin-top: 1rem;
        }

        .reset-links a {
            color: #007bff;
            text-decoration: none;
        }

        .reset-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="card">
            <div class="card-header">Reset Password</div>
            <div class="card-body">
                <form method="POST" action="<?=site_url('auth/password-reset');?>">
                    <?php csrf_field(); ?>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control" name="email" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>

                    <div class="reset-links">
                        <a href="<?=site_url('auth/login');?>">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
