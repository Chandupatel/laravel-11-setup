<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \SiteHelper::getSettingsValueByKey('COMPANY_NAME') }}</title>

    <!-- Fonts -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/'.\SiteHelper::getSettingsValueByKey('COMPANY_FAVICON')) }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('storage/assets/admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('storage/assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('storage/assets/admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script>
        var base_url = '{{ url('/') }}';
    </script>
    <script src="{{ asset('storage/assets/admin/js/plugin.js') }}"></script>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('storage/assets/admin/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/node-waves/waves.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('storage/assets/admin/js/app.js') }}"></script>
    <script src="{{ asset('storage/assets/common-scripts/form-hendler.js') }}"></script>

    @yield('scripts')
</body>

</html>
