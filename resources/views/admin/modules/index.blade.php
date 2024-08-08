@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Modules</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body border-bottom">
                        <div class="d-flex align-items-center">
                            {{-- <a href="{{route('admin.modules.index')}}" class="btn btn-secondary btn-rounded">
                                <i class="bx bx-left-arrow-alt"></i>
                            </a> --}}
                            <h5 class="mb-0 card-title flex-grow-1"></h5>
                            <div class="flex-shrink-0">
                                <a href="javascript:void(0);"class="btn btn-outline-primary waves-effect waves-light"
                                    onclick="openCrateEditModal('{{ route('admin.modules.create') }}')">Add New module</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form id="dataTableSearchForm">
                            <div class="row g-3">
                                <div class="col-xxl-3 col-lg-3">
                                    <input type="search" name="name" class="form-control" id="name"
                                        placeholder="Search for Name...">
                                </div>
                            </div>
                            <div class="row g-2 justify-content-end">
                                <div class="col-md-1 col-lg-1">
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light w-100"
                                        onclick="filterDataTable('moduleDataTable');">
                                        <i class="mdi mdi-filter-outline align-middle"></i> Filter
                                    </button>
                                </div>
                                <div class="col-md-1 col-lg-1">
                                    <button type="button" class="btn btn-outline-dark waves-effect waves-light w-100"
                                        onclick="resetDataTable('moduleDataTable','dataTableSearchForm');">
                                        <i class="fas fa-undo-alt align-middle"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $dataTable->table() }}

                        </div>
                    </div>
                    <!-- end card body -->
                </div><!--end card-->
            </div><!--end col-->
        </div>
    </div>

    <div id="moduleAddEditModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modalContentSection">
            <!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    @include('layouts.admin.datatable.script')
    <script type="text/javascript">
        
        function openCrateEditModal(url) {
            callGetRequest(url, [], function(response) {
                openFormModal("#moduleAddEditModal","#modalContentSection",response );
            });
        }
        function submitPostForm(form_id) {
            if (checkFormValidation(form_id)) {
                let data = new FormData($(form_id)[0]);
                let url = $(form_id).attr('action');
                callPostRequest(url, data, function(response) {
                    hendalFormResponse(form_id,response,"#moduleAddEditModal","moduleDataTable")
                })
            }
        }
    </script>
@endsection
