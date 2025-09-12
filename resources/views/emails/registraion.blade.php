<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Registration Confirmation</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; }
    .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 12px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .header { text-align: center; padding-bottom: 15px; border-bottom: 1px solid #eee; }
    .header h1 { color: #333; font-size: 22px; }
    .content { padding: 20px; color: #555; font-size: 16px; line-height: 1.6; }
    .button { display: inline-block; margin-top: 20px; padding: 12px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 8px; }
    .footer { text-align: center; margin-top: 30px; font-size: 13px; color: #888; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Welcome to Our Platform!</h1>
    </div>
    <div class="content">
      <p>Hi, {{$body['user_name']}}</p>
      <p>Thank you for registering with us. Your account has been created successfully.</p>
      
      
      
    </div>
    
  </div>
</body>
</html>
