<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f6f6f6; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background: #ffffff; padding: 20px; border-radius: 6px;">
                    <tr>
                        <td>
                            <h2>Hello {{ $user->name }}, 👋</h2>
                            <p>Welcome to our platform! We’re excited to have you with us.</p>

                            <p>
                                If you have any questions, just reply to this email — we’re here to help.
                            </p>
                            <p style="margin-top: 20px;">
                                Cheers, <br>
                                <strong>The Team</strong>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
