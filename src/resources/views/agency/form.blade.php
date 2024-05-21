<div class="form-group {{ $errors->has('agency_name') ? 'has-error' : ''}}">
    <label for="agency" class="control-label">{{ 'Agency' }}</label>
    <input class="form-control" style="border-radius: 12px" name="agency_name" type="text" id="agency" value="{{ isset($agency->agency_name) ? $agency->agency_name : ''}}" >
    {!! $errors->first('agency_name', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group" style="margin-top: 10px">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
