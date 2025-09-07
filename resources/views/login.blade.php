<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        WEBINAR ON MUTUAL FUND INVESTMENT ORGANISED BY
        ADITYA BIRLA SUN LIFE MUTUAL FUND
    </title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    @php
        $semid = $semid ?? 1;
        $vendor = $vendor ?? 1;
    @endphp

    <div class="col-xl-12 col-lg-12 col-md-12 bg-gradient-secondary text-center" style="background-color: #819F79;">
        <img src="{{ asset('assets/img/header.png') }}" class="img-fluid text-center mx-auto" alt="Responsive image">
    </div>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-1">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-lg-block bg-login-image text-center mt-1">
                                <img src="{{ asset('assets/img/seminar/abseminar-1.jpg') }}" class="img-fluid text-center mx-auto" alt="Responsive image">
                            </div>

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if(session('fail'))
                                        <div class="alert alert-danger">
                                            {{ session('fail') }}
                                        </div>
                                    @endif


                                    <form class="user needs-validation"  action="{{ route('user-login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control form-control-user"
                                                   id="phone"
                                                   name="phone"
                                                   type="tel"
                                                   pattern=".{10}"
                                                   required
                                                   placeholder="Phone no."
                                                   oninput="check(this)">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                            <br/>Starting in :
                                            <h3><p id="webinar"></p></h3>
                                        </div>

                                        <input type="hidden" name="semid" value="{{ $semid }}">
                                        <input type="hidden" name="vendor" value="{{ $vendor }}">

                                        <button class="btn btn-google btn-block" name="loginSubmit" value="loginSubmit">Login</button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{route('register',['semid'=>$semid,'vendor'=>$vendor])}}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    
</body>
</html>
