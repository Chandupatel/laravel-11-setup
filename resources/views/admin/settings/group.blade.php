@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Settings </h4>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.settings.update.group',$group) }}" id="PostForm">
                            <div class="row">
                                @if (!empty($settings))
                                    @foreach ($settings as $index => $item)
                                        @if ($item->input_type == 'text')
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="{{ $item->key }}-input"
                                                        class="form-label">{{ $item->label }}</label>
                                                    <input type="text" name="{{ $item->key }}" class="form-control"
                                                        id="{{ $item->key }}-name-input"
                                                        placeholder="Enter {{ $item->label }}" value="{{ $item->value }}"
                                                        required>
                                                    <span class="text-danger error-span pt-2"
                                                        id="error_{{ $item->key }}"> </span>
                                                </div>
                                            </div>
                                        @elseif ($item->input_type == 'file')
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="{{ $item->key }}-input"
                                                        class="form-label">{{ $item->label }}</label>
                                                    <input type="file" name="{{ $item->key }}" class="form-control"
                                                        id="{{ $item->key }}-name-input"
                                                        placeholder="Enter {{ $item->label }}"
                                                        value="{{ $item->value }}">
                                                    <span class="text-danger error-span pt-2"
                                                        id="error_{{ $item->key }}"> </span>
                                                </div>
                                            </div>
                                        @elseif ($item->input_type == 'select')
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $item->label }}</label>
                                                    @php
                                                        $input_options = [];
                                                        if ($item->input_options) {
                                                            $input_options = $item->input_options;
                                                        }
                                                    @endphp
                                                    <select class="form-control select2"
                                                        id="formrow-{{ $item->key }}-input" name="{{ $item->key }}">
                                                        <option value="">Select {{ $item->label }}</option>

                                                        @if (!empty($input_options))
                                                            @foreach ($input_options as $options)
                                                                <option value="{{ $options }}"
                                                                    {{ $item->value == $options ? 'selected' : '' }}>
                                                                    {{ $options }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                    <span class="text-danger error-span pt-2"
                                                        id="error_{{ $item->key }}"> </span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
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
        $(".select2").select2();

        function submitChangePasswordForm(form_id) {
            if (checkFormValidation(form_id)) {
                let data = new FormData($(form_id)[0]);
                callPostRequest('{{ route('admin.settings.update.group',$group) }}', data, function(response) {
                    hendalFormResponse(form_id, response)
                })
            }
        }
    </script>
@endsection
