<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <table style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <tr>
            <td align="center">
                <h1>Password Recovery</h1>
            </td>
        </tr>
        <tr>
            <td>
                <p>Dear {{ $name }},</p>
                <p>We have received a request to reset your password. Click on the following link to proceed with the process:</p>
                <p><a href="{{env("FRONTEND_URL")}}/password-recover/{{ $token}}">Reset Password</a></p>
                <p>If you have not requested to reset your password, you can ignore this email.</p>
                <p>Regards,</p>
                <p>Coach IT Team &copy;</p>
            </td>
        </tr>
    </table>

</body>
</html>
