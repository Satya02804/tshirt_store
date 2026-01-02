<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Reset Your Password</title>
    <style>
        /* Responsive fixes for mobile */
        @media only screen and (max-width: 620px) {
            table.body h1 { font-size: 28px !important; margin-bottom: 10px !important; }
            table.body p, table.body ul, table.body ol, table.body td, table.body span, table.body a { font-size: 16px !important; }
            table.body .wrapper, table.body .article { padding: 10px !important; }
            table.body .content { padding: 0 !important; }
            table.body .container { padding: 0 !important; width: 100% !important; }
            table.body .main { border-left-width: 0 !important; border-radius: 0 !important; border-right-width: 0 !important; }
        }
    </style>
</head>
<body style="background-color: #f6f6f9; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f9; width: 100%;">
        <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
            <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;">

                <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">

                    <div style="text-align: center; margin-bottom: 20px;">
                       <h2 style="color: #333; margin: 0;">T-Shirt Store</h2>
                    </div>

                    <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 8px; width: 100%; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <tr>
                            <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 30px;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                            <h1 style="color: #1a1a1a; font-family: sans-serif; font-weight: 700; line-height: 1.4; margin: 0; margin-bottom: 20px; font-size: 24px; text-align: center;">Reset Password Request</h1>

                                            <p style="font-family: sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555;">Hello,</p>

                                            <p style="font-family: sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 25px; color: #555;">
                                                We received a request to reset the password for your account. If you made this request, please click the button below.
                                            </p>

                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 25px;">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #2c3e50; border-radius: 6px; text-align: center;">
                                                                            <a href="{{ url('/reset-password/'.$token) }}" target="_blank" style="display: inline-block; color: #ffffff; background-color: #2c3e50; border: solid 1px #2c3e50; border-radius: 6px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 16px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #2c3e50;">Reset Password</a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 20px; color: #777;">
                                                If you did not request a password reset, you can safely ignore this email. Your password will remain unchanged.
                                            </p>

                                            <hr style="border: 0; border-bottom: 1px solid #eeeeee; margin: 20px 0;">
                                            <p style="font-family: sans-serif; font-size: 12px; color: #999; margin-bottom: 10px;">
                                                If you're having trouble clicking the button, copy and paste the URL below into your web browser:
                                            </p>
                                            <p style="font-family: sans-serif; font-size: 12px; margin: 0; word-break: break-all;">
                                                <a href="{{ url('/reset-password/'.$token) }}" style="color: #3498db; text-decoration: underline;">
                                                    {{ url('/reset-password/'.$token) }}
                                                </a>
                                            </p>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                            <tr>
                                <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;">
                                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">T-Shirt Store Inc, 123 Fashion Street, City</span>
                                    <br> Don't like these emails? <a href="#" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">Unsubscribe</a>.
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </td>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        </tr>
    </table>
</body>
</html>
