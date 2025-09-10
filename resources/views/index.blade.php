@extends('layouts.auth-layout')

@section('title', 'Webinar Login')

@section('content')
<div class="container login-container min-vh-100 d-flex align-items-center justify-content-center">
  <div class="row g-0 bg-white shadow-md rounded-5">

    <!-- Left panel -->
    <div class="col-md-6 left-panel p-4 pt-5 p-md-5 d-flex flex-column justify-content-center align-items-center">
      <img src="{{ asset('/assets/img/wis-logo.png') }}" alt="Webinar Illustration" class="mb-3 mb-lg-4">
      <h3 class="text-theme">Join Engaging Webinars</h3>
      <p class="text-muted mb-0">Learn, connect, and grow through interactive online sessions.</p>
    </div>

    <!-- Right panel -->
    <div class="col-md-6 right-panel pb-5 bg-white p-4 p-md-5">
      
      @include('components.alerts')

      <h2 class="text-center mb-3">Welcome Back</h2>
      <p class="text-center text-muted">Login to your Webinar account</p>
      
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="text" name="email" class="form-control" placeholder="Enter email">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>

        <div class="mt-3 mt-lg-4">
          <button type="submit" class="btn btn-primary w-100 py-2 py-lg-3">Sign In</button>
        </div>
      </form>

      <div class="mt-3 d-flex gap-2 justify-content-between align-items-center flex-column flex-sm-row">
        <div>
          <a href="{{ route('vendor-login', \Crypt::encrypt(0)) }}" class="text-theme fw-semibold text-decoration-none link-hover">Vendor Login</a>
        </div>
        <div>
          <a href="{{ route('user-login') }}" class="text-theme fw-semibold text-decoration-none link-hover">Participant Login Here</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
