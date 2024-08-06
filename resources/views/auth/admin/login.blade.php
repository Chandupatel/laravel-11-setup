@extends('layouts.admin-auth')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary-subtle">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p>Sign in to continue to {{\SiteHelper::getSettingsValueByKey('COMPANY_NAME')}}.</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ asset('storage/assets/admin/images/profile-img.png') }}" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="auth-logo">
                        <a href="{{route('admin.admin')}}" class="auth-logo-light">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{ asset('storage/assets/admin/images/logo-light.svg') }}" alt=""
                                        class="rounded-circle" height="34">
                                </span>
                            </div>
                        </a>
                        <a href="{{route('admin.admin')}}" class="auth-logo-dark">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{ asset('storage/assets/admin/images/logo.svg') }}" alt=""
                                        class="rounded-circle" height="34">
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="p-2">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.login') }}" id="PostForm">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                    placeholder="Enter Email" required>
                                <span class="text-danger error-span pt-2" id="error_email">@error('email'){{ $message }}@enderror </span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" id="password" class="form-control  @error('password') is-invalid @enderror" name="password"
                                        placeholder="Enter password" aria-label="Password" aria-describedby="password-addon"
                                        required>
                                    <button class="btn btn-light "type="button" id="password-addon">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </button>
                                </div>
                                <span class="text-danger error-span pt-2" id="error_password">@error('password'){{ $message }}@enderror</span>
                            </div>
                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="button"
                                    onclick="submitLoginForm('#PostForm')">
                                    Log In
                                </button>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot
                                    your password?</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function submitLoginForm(form_id) {
            if (checkFormValidation(form_id)) {
                $(form_id).submit()
            }
        }
    </script>
@endsection
