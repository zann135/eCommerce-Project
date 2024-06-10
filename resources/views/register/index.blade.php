@extends('layouts/main-auth')

@section('content')
    
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <img src="{{ asset('images/logo-cabein.svg') }}" alt="logo" class="w-25">
                        </div>
                        <h4>New here?</h4>
                        <h6 class="fw-light">Signing up is easy. It only takes a few steps</h6>
                        <form action="{{ route('proses_register') }}" method="POST" class="pt-3 forms-sample material-form bordered" id="register-form">
                            @csrf
                            <div class="mt-3 form-group">
                                <input type="text" id="name" name="name" required="required" />
                                <label for="input" class="control-label">Name</label><i class="bar"></i>
                            </div>
                            <div class="mt-3 form-group">
                                <input type="text" id="username" name="username" required="required" />
                                <label for="input" class="control-label">Username</label><i class="bar"></i>
                            </div>
                            <div class="mt-3 form-group">
                                <input type="email" id="email" name="email" required="required" />
                                <label for="input" class="control-label">Email address</label><i class="bar"></i>
                            </div>
                            <div class="mt-3 form-group">
                                <input type="password" id="password" name="password" required="required" />
                                <label for="input" class="control-label">Password</label><i class="bar"></i>
                            </div>
                            <div class="mt-3 form-group">
                                <input type="tel" id="phone" name="phone" required="required" />
                                <label for="input" class="control-label">Phone Number</label><i class="bar"></i>
                            </div>
                            <div class="mt-3 form-group">
                                <textarea id="address" name="address" required="required"></textarea>
                                <label for="textarea" class="control-label">Address</label><i class="bar"></i>
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">SIGN UP</button>
                            </div>
                            <div class="text-center mt-4 fw-light"> Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
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

@section('my_script')

<script>
    
    document.getElementById('phone').addEventListener('input', function (e) {
        let input = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
        let formatted = '';

        if (input.length > 0) {
            formatted += input.substring(0, 4);
        }
        if (input.length > 4) {
            formatted += '-' + input.substring(4, 8);
        }
        if (input.length > 8) {
            formatted += '-' + input.substring(8, 13);
        }

        e.target.value = formatted;
    });

    document.getElementById('register-form').addEventListener('submit', function (e) {
        let phoneInput = document.getElementById('phone');
        phoneInput.value = phoneInput.value.replace(/-/g, '');
    });

</script>

@endsection