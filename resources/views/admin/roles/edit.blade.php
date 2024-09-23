<div class="modal-content">
    <form method="POST" action="{{route('admin.roles.update',$obj->id)}}" id="PostForm">
        <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Edit Role</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="formrow-name-input" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="formrow-name-input"
                            placeholder="Enter Your Name" value="{{$obj->name}}" required>
                        <span class="text-danger error-span pt-2" id="error_name"> </span>
                    </div>
                </div>
                <div class="col-md-6">
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
