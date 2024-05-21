<div class="form-group {{ $errors->has('leave_type_name') ? 'has-error' : ''}}">
    <label for="leave_type_name" class="control-label">{{ 'Leave Type Name' }}</label>
    <select name="leave_type_name" class="form-control" id="leave_type_name" >
    @foreach (json_decode('{"ลาพักผ่อน":"\u0e25\u0e32\u0e1e\u0e31\u0e01\u0e1c\u0e48\u0e2d\u0e19","ลากิจ":"\u0e25\u0e32\u0e01\u0e34\u0e08","ลาป่วย":"\u0e25\u0e32\u0e1b\u0e48\u0e27\u0e22"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($leavetype->leave_type_name) && $leavetype->leave_type_name == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('leave_type_name', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group" style="margin-top: 10px">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
