<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>404 - الصفحة غير موجودة</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@600;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: #fff;
            overflow: hidden;
        }

        .container {
            text-align: center;
            padding: 30px;
        }

        h1 {
            font-size: 12rem;
            font-weight: 800;
            color: #e74c3c;
            text-shadow: 6px 6px 0px #f1c40f;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0);
            }
        }

        h2 {
            font-size: 2rem;
            margin-top: 15px;
        }

        p {
            margin: 10px 0 30px;
            font-size: 1.2rem;
            color: #f1f1f1;
        }

        a {
            display: inline-block;
            padding: 12px 25px;
            background: #fff;
            color: #2980b9;
            font-weight: bold;
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s;
        }

        a:hover {
            background: #e67e22;
            color: #fff;
        }

        .emoji {
            font-size: 3rem;
            margin-top: 15px;
            animation: swing 2s infinite;
        }

        @keyframes swing {
            0% {
                transform: rotate(0deg);
            }
            25% {
                transform: rotate(10deg);
            }
            50% {
                transform: rotate(0deg);
            }
            75% {
                transform: rotate(-10deg);
            }
            100% {
                transform: rotate(0deg);
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>404</h1>
    <h2>الصفحة غير موجودة 😢</h2>
    <p>عذرًا، الصفحة التي تبحث عنها غير متوفرة أو تم نقلها.</p>
    <a href="{{ url('/') }}">🏠 العودة إلى الرئيسية</a>
    <div class="emoji">🔎</div>
</div>
</body>
</html>
