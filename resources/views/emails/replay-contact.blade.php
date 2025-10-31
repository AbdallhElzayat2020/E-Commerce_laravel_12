<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        /* Basic responsive email styles (inline-safe) */
        body {
            margin: 0;
            padding: 0;
            background-color: #f3f6fb;
            font-family: Arial, Helvetica, sans-serif;
            color: #0f172a;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }

        .container {
            width: 100%;
            background: #f3f6fb;
            padding: 24px 0;
        }

        .wrapper {
            max-width: 640px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .header {
            padding: 20px 24px;
            background: #0f172a;
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
        }

        .content {
            padding: 24px;
        }

        .title {
            margin: 0 0 12px;
            font-size: 20px;
            line-height: 28px;
            color: #0f172a;
        }

        .greeting {
            margin: 0 0 12px;
            color: #334155;
        }

        .panel {
            margin: 16px 0;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #0f172a;
        }

        .footer {
            padding: 16px 24px;
            color: #475569;
            font-size: 12px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background: #2563eb;
            color: #ffffff !important;
            border-radius: 6px;
            font-weight: 600;
        }
    </style>
    <!--[if mso]>
    <style>
      .wrapper { width: 640px !important; }
    </style>
    <![endif]-->
</head>

<body>
    <table class="container" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="header">
                            {{ config('app.name') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <h1 class="title">{{ $subject }}</h1>
                            <p class="greeting">Hello {{ $clientName }},</p>
                            <div class="panel">
                                {{ $replayMessage }}
                            </div>
                            <p>If you have any further questions, just reply to this email.</p>
                            <p>
                                <a href="{{ config('app.url') }}" class="btn">Visit Our Website</a>
                            </p>
                            <p style="margin-top:24px;">Best regards,<br>{{ config('app.name') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
