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
                                <div class="col-md-4 text-center">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <img class="rounded-circle avatar-xl" alt="200x200"
                                                    src="http://localhost/laravel-11-app/public_html/storage/assets/admin/images/users/avatar-1.jpg"
                                                    data-holder-rendered="true">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="file"name="profile_image" class="form-control"
                                                    id="formrow-profile_image-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-name-input" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    id="formrow-name-input" placeholder="Enter Your Name"
                                                    value="{{ Auth::user()->name }}" required>
                                                <span class="text-danger error-span pt-2" id="error_name">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-email-input" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="formrow-email-input"
                                                    placeholder="Enter Your Email" value="{{ Auth::user()->email }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary w-md"
                                    onclick="submitProfileForm('#PostForm')">Submit</button>
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
        function submitProfileForm(form_id) {
            if (checkFormValidation(form_id)) {
                let data = new FormData($(form_id)[0]);
                callPostRequest('{{ route('admin.update-profile') }}', data, function(response) {
                    hendalFormResponse(form_id,response)
                })
            }
        }
    </script>
@endsection
