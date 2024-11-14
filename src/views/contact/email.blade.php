
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Message</title>
</head>
<body>
    <h1>New Contact Message</h1>
    
    <p>Hello,</p>
    <p>You have received a new message from your contact form:</p>
    
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>
    
    <br>
    <p>Thank you!</p>
</body>
</html>
