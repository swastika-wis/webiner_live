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
.top-logo-img img{
  max-width:100%
}
@media (max-width: 768px) {
  .left-panel img {
    max-width: 60%;
  }
  .form-control {
      min-height: 50px;
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
  .login-container {
    margin: 30px 0;
  }
}

  </style>
</head>
<body>
  <div class="container login-container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row bg-white shadow-md rounded-5 px-2 py-4 p-lg-5">
      <div class="col-12 mb-3 mb-lg-4">
        <div class="d-flex flex-column flex-sm-row justify-content-center gap-4 align-items-center">
          <div class="top-logo-img">
            <img src="{{ asset('/storage/app/public/'.$record->vendorRecord->logo2) }}" alt=""  height="100px">
          </div>
          {{-- <div>
            <img src="{{ asset('/storage/app/public/'.$record->vendorRecord->logo3) }}" alt="" width="200px" height="100px">
          </div> --}}
        </div>
      </div>
      <!-- Left panel -->
      <div class="col-md-6 left-panel d-flex flex-column justify-content-center align-items-center" 
      style="background: url({{ asset('/storage/app/public/'.$record->vendorRecord->logo) }}) no-repeat center center; background-size: contain;">
        
      </div>
      
      <!-- Right panel -->
      <div class="col-md-6 right-panel ps-3 ps-lg-5 bg-white">

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
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="text" name="name" placeholder="Full Name" class="form-control" value="{{old('name')}}">
            </div>



            <div class="form-group mb-2">
                  @error('company_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="text" name="company_name" placeholder="Company Name" class="form-control" value="{{old('company_name')}}">
            </div>


             <div class="form-group mb-2">
                
              @error('designation')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="text" name="designation" placeholder="Designation" class="form-control" value="{{old('designation')}}">
            </div>            
                <div class="form-group mb-2">  
                  
                 @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror

                    <input type="text" name="email" placeholder="Email" class="form-control" value="{{old('email')}}">
                </div>

                <div class="form-group mb-2">  
                   @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror

                    <input type="text" name="phone" placeholder="Phone Number" class="form-control" value="{{old('phone')}}">
                </div>


                 <div class="form-group mb-2">
                
                   @error('field')
                <span class="text-danger">{{$message}}</span>
                @enderror

                <input type="text" name="field" placeholder="Products / Services" class="form-control" value="{{old('field')}}">
            </div>

             <div class="form-group mb-2">
                    
              @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror

                    <input type="password" name="password" placeholder="Create your own Password" class="form-control" value="{{old('password')}}">
              </div>

              
                <div class="form-group mb-2">
                <label for="topic" class="block form-label text-sm fw-semibold text-gray-700 mb-1">
                  <small>Would you like to share names and email ids of your colleagues to participate?</small>  </label>
                <textarea name="refer" class="form-control"></textarea>
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
