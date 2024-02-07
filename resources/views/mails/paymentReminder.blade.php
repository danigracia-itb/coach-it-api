<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Reminder</title>
</head>
<body>
    <p>Dear {{ $athlete }},</p>

    <p>This is a friendly reminder that your {{$payment_type}} payment of €{{ $quantity }} for coaching services is due on or before <strong> {{ $date }}</strong>.</p>

    <p>If you have already made the payment, please disregard this message. Otherwise, kindly ensure that the payment is made by the specified date to avoid any inconvenience.</p>

    <p>Thank you for your prompt attention to this matter.</p>

    <p>Sincerely,<br>
        {{$coach}}<br>
</body>
</html>
