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
        
        <p>Your booking has been rejected due to the following reason:</p>
        <p>{{ $reason }}</p>
        <p>We apologize for inconvenience caused.</p>
    </div>
</body>
</html>
