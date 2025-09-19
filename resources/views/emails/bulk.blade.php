<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        .btn {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .footer {
            text-align: left;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="container">
        {{$body['body']}}
    </div>

</body>
</html>
