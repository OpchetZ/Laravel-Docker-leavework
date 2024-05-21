<div class="form-group {{ $errors->has('status_name') ? 'has-error' : ''}}">
    <label for="status_name" class="control-label">{{ 'สถาณะ' }}</label>
    <input class="form-control" style="border-radius: 12px" name="status_name" type="text" id="status_name" value="{{ isset($status->status_name) ? $status->status_name : ''}}" >
    {!! $errors->first('status_name', '<p class="help-block">:message</p>') !!}
</div>



<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
