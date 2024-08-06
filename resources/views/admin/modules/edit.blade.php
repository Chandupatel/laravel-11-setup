<div class="modal-content">
    <form method="POST" action="{{route('admin.modules.update',$obj->id)}}" id="PostForm">
        <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Edit Module</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Parent Module</label>
                        <select class="form-control select2" id="formrow-parent_id-input" name="parent_id">
                            <option value="">Select Parent Module</option>
                            @if (!empty($modules))
                                @foreach ($modules as $item)
                                    <option value="{{ $item->id }}" {{$item->id == $obj->parent_id ? 'selected' :''}}>{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="text-danger error-span pt-2" id="error_parent_id"> </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="formrow-name-input" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="formrow-name-input"
                            placeholder="Enter Your Name" value="{{$obj->name}}" required>
                        <span class="text-danger error-span pt-2" id="error_name"> </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="formrow-active_cases-input" class="form-label">Active Cases</label>
                        <input type="text" name="active_cases" class="form-control" id="formrow-active_cases-input"
                            placeholder="Enter Active Cases" value="{{$obj->active_cases}}" required>
                        <span class="text-danger error-span pt-2" id="error_active_cases"> </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="formrow-icon-input" class="form-label">Icon</label>
                        <input type="text" name="icon" class="form-control" id="formrow-icon-input"
                            placeholder="Enter Icon" value="{{$obj->icon}}" required>
                        <span class="text-danger error-span pt-2" id="error_icon"> </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="formrow-route_name-input" class="form-label">Route Name</label>
                        <input type="text" name="route_name" class="form-control" id="formrow-route_name-input"
                            placeholder="Enter Route Name" value="{{$obj->route_name}}" required>
                        <span class="text-danger error-span pt-2" id="error_route_name"> </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="formrow-route_params-input" class="form-label">Route Params</label>
                        <input type="text" name="route_params" class="form-control" id="formrow-route_params-input"
                            placeholder="Enter Route Params" value="{{$obj->route_params}}">
                        <span class="text-danger error-span pt-2" id="error_route_params"> </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Multi Level</label>
                        <select class="form-control select2" id="formrow-is_multi_level-input" name="is_multi_level">
                            <option value="">Select Multi Level</option>
                            <option value="0" {{$obj->is_multi_level ==0 ? 'selected' :''}}>No</option>
                            <option value="1" {{$obj->is_multi_level ==1 ? 'selected' :''}}>Yes</option>
                        </select>
                        <span class="text-danger error-span pt-2" id="error_is_multi_level"> </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control select2" id="formrow-status-input" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Active" {{$obj->status =="Active" ? 'selected' :''}}>Active</option>
                            <option value="InActive" {{$obj->status =="InActive" ? 'selected' :''}}>InActive</option>
                        </select>
                        <span class="text-danger error-span pt-2" id="error_status"> </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="submitPostForm('#PostForm')">Save</button>
        </div>
    </form>
</div>
