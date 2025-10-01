<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>403 - ممنوع الوصول</title>
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
            background: linear-gradient(135deg, #1abc9c, #16a085);
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
            text-shadow: 6px 6px 0px #f39c12;
            animation: bounce 2s infinite alternate;
        }

        @keyframes bounce {
            from { transform: translateY(0px); }
            to   { transform: translateY(-25px); }
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
            color: #16a085;
            font-weight: bold;
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s;
        }

        a:hover {
            background: #f39c12;
            color: #fff;
        }

        .emoji {
            font-size: 3rem;
            margin-top: 15px;
            animation: shake 1s infinite;
        }

        @keyframes shake {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(5deg); }
            50% { transform: rotate(0deg); }
            75% { transform: rotate(-5deg); }
            100% { transform: rotate(0deg); }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>403</h1>
    <h2>ممنوع الوصول 🚫</h2>
    <p>عذرًا، لا تملك صلاحية لعرض هذه الصفحة.</p>
    <a href="{{ url('/') }}">🏠 العودة إلى الرئيسية</a>
    <div class="emoji">🔒</div>
</div>
</body>
</html>
