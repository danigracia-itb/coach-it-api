<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Email</title>
</head>
<body>
    <p>Has recibido un nuevo mensaje de contacto:</p>
    <ul>
        <li><strong>Correo electrónico:</strong> {{ $data['email'] }}</li>
        <li><strong>Subject:</strong> {{ $data['subject'] }}</li>
        <li><strong>Mensaje:</strong> {{ $data['message'] }}</li>
    </ul>
</body>
</html>
