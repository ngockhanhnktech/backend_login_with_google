<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f0f2f5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .google-btn {
            display: block;
            background: #4285F4;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 12px;
            cursor: pointer;
            transition: 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .google-btn:hover {
            background: #357ae8;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Đăng nhập</h2>

        @if(session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <a href="{{ route('google.login') }}" class="google-btn">
            Đăng nhập với Google
        </a>
    </div>

</body>
</html>
