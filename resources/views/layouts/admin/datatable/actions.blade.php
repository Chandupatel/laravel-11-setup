<ul class="list-unstyled hstack gap-1 mb-0">
    @if (!empty($actions['view_url']))
        <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
            <a href="#" class="btn btn-sm btn-soft-primary">
                <i class="mdi mdi-eye-outline"></i>
            </a>
        </li>
    @endif
    @if (!empty($actions['edit_url']))
        <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
            <a href="javascript:void(0);" class="btn btn-sm btn-soft-info" onclick="openCrateEditModal('{{$actions['edit_url']}}')">
                <i class="mdi mdi-pencil-outline"></i>
            </a>
        </li>
    @endif
    @if (!empty($actions['delete_url']))
        <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
            <a href="javascript:void(0);" class="btn btn-sm btn-soft-danger deleteButton" action-url="{{$actions['delete_url']}}">
                <i class="mdi mdi-delete-outline"></i>
            </a>
        </li>
    @endif
</ul>
