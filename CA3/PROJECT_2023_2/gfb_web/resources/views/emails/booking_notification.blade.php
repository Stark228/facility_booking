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
        <h2>New Booking Notification</h2>
    
        <p>Hello Admin,</p>
        
        <p>A new booking has been made by {{ $userName }} ({{ $userEmail }}) for the facility: {{ $facilityName }}.</p>
        
        <p>Thank you.</p>
    </div>
</body>
</html>
