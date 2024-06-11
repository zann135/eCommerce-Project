
@extends('layouts/main-auth')

@section('content')
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              @if ($errors->has('login_gagal'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ $errors->first('login_gagal') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <img src="{{ asset('images/logo-cabein.svg') }}" alt="logo" class="w-25">
                </div>
                <h4>Hello!</h4>
                <h6 class="fw-light">Sign in to continue.</h6>
                <form action="{{ route('proses_login') }}" method="POST" class="pt-3 forms-sample material-form bordered">
                  @csrf
                  <div class="mt-3 form-group">
                    <input type="text" id="username" name="username" required="required" />
                    <label for="input" class="control-label">Username</label><i class="bar"></i>
                  </div>
                  <div class="mt-3 form-group">
                    <input type="password" id="password" name="password" required="required" />
                    <label for="input" class="control-label">Password</label><i class="bar"></i>
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">SIGN IN</button>
                  </div>
                  <div class="text-center mt-4 fw-light"> Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection