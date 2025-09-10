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
      max-width: 1000px;
      /* margin: 50px auto;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1); */
    }
    .left-panel {
      background: #a3d2ca;
      color: #fff;
      text-align: center;
      /* padding: 40px; */
    }
    .left-panel img {
      max-width: 80%;
      height: auto;
      /* margin-bottom: 20px; */
    }
    .right-panel {
      /* padding: 40px; */
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
        .form-control {
      min-height: 48px;
    }
    .text-theme{
      color: #033c71;
    }
    .btn-primary {
    --bs-btn-color: #fff !important;
    --bs-btn-bg: #033c71 !important;
    --bs-btn-border-color: #033c71 !important;
    --bs-btn-hover-color: #fff !important;
    --bs-btn-hover-bg: #edbd03 !important;
    --bs-btn-hover-border-color: #edbd03 !important;
    --bs-btn-focus-shadow-rgb: 49, 132, 253;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #edbd03;
    --bs-btn-active-border-color: #033c71;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #fff;
    --bs-btn-disabled-bg: #033c71;
    --bs-btn-disabled-border-color: #033c71;
}
@media (max-width: 768px) {
  .left-panel img {
    max-width: 60%;
  }
  .form-control {
      min-height: 44px;
  }
  .left-panel{
    border-top-right-radius: 20px;
    border-bottom-left-radius: 0px;
  }
  .right-panel{
    border-top-right-radius: 0px;
    border-bottom-right-radius: 20px;
    border-bottom-left-radius: 20px;
  }
}

  </style>
</head>
<body>
  <div class="container login-container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row bg-white shadow-md rounded-5 p-5">
      <div class="col-12 mb-3 mb-lg-4">
        <div class="d-flex flex-column flex-sm-row justify-content-center gap-4 align-items-center">
          <div>
            <img src="{{ asset('/public/storage/' . $record->vendorRecord->logo) }}" alt="" width="100px" height="100px">
          </div>
          <div>
            <img src="{{ asset('/public/storage/' . $record->vendorRecord->logo) }}" alt="" width="100px" height="100px">
          </div>
        </div>
      </div>
      <!-- Left panel -->
      <div class="col-md-6 left-panel d-flex flex-column justify-content-center align-items-center" style="background: url({{ asset('/public/storage/' . $record->vendorRecord->logo) }}) no-repeat center center; background-size: contain;">
        
      </div>
      
      <!-- Right panel -->
      <div class="col-md-6 right-panel ps-5 bg-white">

        @if(session('fail'))
          <div class="alert alert-danger">{{session('fail')}}</div>
        @endif

        @if(session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
        @endif

        
       
        <h2 class="text-2xl font-semibold mb-4 text-theme">Book your seat for <strong>{{$record->topic}}</strong></h2>
        <form action="{{route('store-participent')}}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="meeting_id" value="{{$meeting_id}}">
            <div class="form-group mb-2">
                <label for="topic" class="block form-label text-sm fw-semibold text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" required
                       class="form-control">
            </div>

            
                <div class="form-group mb-2">
                    <label for="start_time" class="block form-label text-sm fw-semibold text-gray-700 mb-1">Email</label>
                    <input type="text" name="email" required
                           class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="duration" class="block form-label text-sm fw-semibold text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone" class="form-control">
                </div>


                <div class="form-group mb-2">
                    <label for="duration" class="block form-label text-sm fw-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
        

            <button type="submit" class="btn btn-primary mt-3 w-100 py-2 py-lg-3">
               Register
            </button>
        </form>


      </div>
    </div>
  </div>

  
</body>
</html>
