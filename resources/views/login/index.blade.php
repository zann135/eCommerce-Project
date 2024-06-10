@extends('layouts/main-auth')

@section('content')
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo text-center">
                  <img src="{{ asset('images/logo-cabein.svg') }}" alt="logo" class="w-25">
                </div>
                <h4 class="text-center">Hello! let's get started</h4>
                <h6 class="fw-light text-center mb-4">Sign in to continue.</h6>
                  <div class="my-2 d-flex justify-content-center align-items-center">
                    <a href="{{ route('login_form') }}" class="btn btn-primary me-2">As Tengkulak</a>
                    <a href="{{ route('login_form') }}" class="btn btn-primary">As Customer</a>
                  </div>
                  <div class="text-center mt-4 fw-light"> Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection