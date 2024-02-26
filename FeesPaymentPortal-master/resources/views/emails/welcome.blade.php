<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Fees Portal-POSB</title>
</head>
<body>
    <p>Welcome to the Fees Portal for POSB! Your account has been created.</p>
    <!-- Update the route to the password reset route -->
    <a href="{{ route('password.reset', $token) }}">Reset Password</a>
    <p>Thank you for joining us!</p>
</body>
</html>
