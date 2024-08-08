<div class="square-switch">
    <input type="checkbox" id="square-switch_{{ $actions['input_id'] }}" switch="bool"
        {{ $actions['status'] == 'Active' ? 'checked' : '' }} class="statusButton"
        action-url="{{ $actions['status_url'] }}">
    <label for="square-switch_{{ $actions['input_id'] }}" data-on-label="Active" data-off-label="InActive">
    </label>
</div>
