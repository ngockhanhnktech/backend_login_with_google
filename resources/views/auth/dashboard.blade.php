<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        .logout-btn {
            display: inline-block;
            background: #e74c3c;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            cursor: pointer;
            transition: 0.3s ease;
            text-decoration: none;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Chào mừng bạn đến Dashboard!</h2>
        <p>Đây là trang chính sau khi đăng nhập thành công.</p>

        <!-- Nút đăng xuất -->
        <a href="{{ route('logout') }}" class="logout-btn">Đăng xuất</a>
    </div>

</body>
</html>
