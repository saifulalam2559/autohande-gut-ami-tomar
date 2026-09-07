<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 50px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            max-width: 500px;
            width: 90%;
        }

        .error-code {
            font-size: 90px;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        p {
            color: #777;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            background: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .button:hover {
            background: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="error-code">403</div>

        <h1>Access Denied</h1>

        <p>
            Sorry, you don't have permission to access this page.
            Please contact the administrator if you believe this is an error.
        </p>

        <a href="/" class="button">Go Back Home</a>
    </div>

</body>
</html>