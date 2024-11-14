<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact us page</title>
</head>
<body>
    <h1> Contact Email </h1>
    <form action="{{ route('send') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Your name">
        <input type="email" name="email" placeholder="Your email">
<textarea name="message" id="" cols="30" rows="10" placeholder="Your Query"></textarea>
<button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>