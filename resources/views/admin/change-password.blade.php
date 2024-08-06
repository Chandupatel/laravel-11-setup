@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Profile</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update-profile') }}" id="PostForm">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Old Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" id="old_password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                name="old_password" placeholder="Enter Old password" aria-label="Password"
                                                aria-describedby="password-addon" required>
                                            <button class="btn btn-light "type="button" id="old_password-addon">
                                                <i class="mdi mdi-eye-outline"></i>
                                            </button>
                                        </div>
                                        <span class="text-danger error-span pt-2" id="error_old_password">
                                            @error('old_password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" id="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                name="password" placeholder="Enter password" aria-label="Password"
                                                aria-describedby="password-addon" required>
                                            <button class="btn btn-light "type="button" id="password-addon">
                                                <i class="mdi mdi-eye-outline"></i>
                                            </button>
                                        </div>
                                        <span class="text-danger error-span pt-2" id="error_password">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" id="confirm_password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                name="confirm_password" placeholder="Enter password" aria-label="Password"
                                                aria-describedby="password-addon" required>
                                            <button class="btn btn-light "type="button" id="confirm_password-addon">
                                                <i class="mdi mdi-eye-outline"></i>
                                            </button>
                                        </div>
                                        <span class="text-danger error-span pt-2" id="error_confirm_password">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary w-md"
                                    onclick="submitChangePasswordForm('#PostForm')">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        function submitChangePasswordForm(form_id) {
            if (checkFormValidation(form_id)) {
                let data = new FormData($(form_id)[0]);
                callPostRequest('{{ route('admin.update-change-password') }}', data, function(response) {
                    hendalFormResponse(form_id,response,"","",'{{ route('admin.dashboard') }}')
                })
            }
        }
    </script>
@endsection
