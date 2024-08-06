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
    <link rel="shortcut icon" href="{{ asset('storage/' . \SiteHelper::getSettingsValueByKey('COMPANY_FAVICON')) }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('storage/assets/admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('storage/assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('storage/assets/admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('storage/assets/admin/libs/toastr/build/toastr.min.css') }}" rel="stylesheet" type="text/css" />

    <!--  select2  -->
    <link href="{{ asset('storage/assets/admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('storage/assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>

    <!--  DataTable  -->
    <link href="{{ asset('storage/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('storage/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('storage/assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css" />

    <script>
        var base_url = '{{ url('/') }}';
    </script>
    <!-- App js -->
    <script src="{{ asset('storage/assets/admin/js/plugin.js') }}"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body data-sidebar="dark">
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.admin.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.admin.sidebar')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                @yield('content')
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.admin.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('storage/assets/admin/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    

    <!-- App js -->
  
    <script src="{{ asset('storage/assets/admin/js/app.js') }}"></script>
    
    <script src="{{ asset('storage/assets/common-scripts/form-hendler.js') }}"></script>
    <script src="{{ asset('storage/assets/common-scripts/api-request-hendler.js') }}"></script>



    <!-- apexcharts -->
    <script src="{{ asset('storage/assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!--  DataTable  -->
    <script src="{{ asset('storage/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
     <!--  DataTable buttons -->
    {{-- <script src="{{ asset('storage/assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script> --}}

    <script src="{{ asset('storage/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('storage/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>



    @yield('scripts')
</body>

</html>
