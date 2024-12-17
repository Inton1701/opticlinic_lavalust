<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Optical Clinic - Login</title>
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <link href="<?=base_url();?>public/css/main.css" rel="stylesheet">
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

        .login-container {
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

        .btn-primary, .btn-secondary {
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

        .login-links {
            text-align: center;
            margin-top: 1rem;
        }

        .login-links a {
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .login-links a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header">Optical Clinic</div>
            <div class="card-body">
                <?php flash_alert(); ?>
                <form method="POST" action="<?=site_url('auth/verify');?>">
                    <a href="<?=site_url('auth/register');?>" class="btn btn-secondary">Don't have an account? Create now</a>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                    
                    <div class="login-links">
                        <a href="<?=site_url('auth/password-reset');?>">Forgot Your Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
