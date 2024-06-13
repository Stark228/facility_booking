<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .logo {
            display: block;
            margin: 0 auto;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Hello {{ $user->name }},</h3>
        <p>Welcome to <strong style="color: #3498db">GCIT Facility Booking!</strong> Your account has been created.</p>
        <p>Your password is: <strong>{{ $password }}</strong></p>
        <p>Please use this password to log in to your account.</p>
        <p>Thank you!</p>
    </div>
</body>
</html>
