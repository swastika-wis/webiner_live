<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Webinar Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f5f5f5;
    }
    .login-container {
      max-width: 950px;
      margin: 50px auto;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .left-panel {
      background: #a3d2ca;
      color: #fff;
      text-align: center;
      padding: 40px;
    }
    .left-panel img {
      max-width: 80%;
      height: auto;
      margin-bottom: 20px;
    }
    .right-panel {
      padding: 40px;
      background: #fff;
    }
    .divider {
      position: relative;
      text-align: center;
      margin: 20px 0;
    }
    .divider::before,
    .divider::after {
      content: "";
      position: absolute;
      top: 50%;
      width: 40%;
      height: 1px;
      background: #ccc;
    }
    .divider::before { left: 0; }
    .divider::after { right: 0; }
    .divider span {
      background: #fff;
      padding: 0 10px;
      color: #777;
      font-size: 14px;
    }
    .google-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #ccc;
      border-radius: 6px;
      padding: 10px;
      cursor: pointer;
      background: #fff;
    }
    .google-btn img {
      width: 20px;
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <div class="container login-container">
    <div class="row g-0">
      <!-- Left panel -->
      <div class="col-md-6 left-panel d-flex flex-column justify-content-center align-items-center">
        <img src="{{asset('/assets/img/wis-logo.png')}}" alt="Webinar Illustration">
        <h3>Join Engaging Webinars</h3>
        <p>Learn, connect, and grow through interactive online sessions.</p>
      </div>
      
      <!-- Right panel -->
      <div class="col-md-6 right-panel">

        @if(session('fail'))
          <div class="alert alert-danger">{{session('fail')}}</div>
        @endif

        @if(session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
        @endif

        <h2 class="text-center mb-3">Welcome Back</h2>
        <p class="text-center text-muted">Login to your Webinar account</p>
        
        <form action="{{route('login')}}" method="post">
         @csrf
          <div class="mb-3">
            <label for="text" class="form-label">Email address</label>
            <input type="text" name="email" class="form-control" placeholder="Enter email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
          </div>
          {{-- <div class="d-flex justify-content-between mb-3">
            <a href="#" class="small">Forgot password?</a>
          </div> --}}
          <button type="submit" class="btn btn-dark w-100">Sign In</button>
        </form>
       
      </div>
    </div>
  </div>

  
</body>
</html>
