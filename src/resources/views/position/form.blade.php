<div class="form-group {{ $errors->has('Job_position') ? 'has-error' : ''}}">
    <label for="Job_position" class="control-label">{{ 'ตำแหน่ง' }}</label>
    <input class="form-control" style="border-radius: 12px" name="Job_position" type="text" id="Job_position" value="{{ isset($position->Job_position) ? $position->Job_position : ''}}" >
    {!! $errors->first('Job_position', '<p class="help-block">:message</p>') !!}
</div>
{{-- <div class="form-group {{ $errors->has('Max_leave') ? 'has-error' : ''}}">
    <label for="Max_leave" class="control-label">{{ 'โควต้าการลา' }}</label>
    <input class="form-control" style="border-radius: 12px" name="Max_leave" type="text" id="Max_leave" value="{{ isset($position->Max_leave) ? $position->Max_leave : ''}}" >
    {!! $errors->first('Max_leave', '<p class="help-block">:message</p>') !!}
</div> --}}


<div class="form-group" style="margin-top: 10px">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'แก้ไข' : 'สร้าง' }}">
</div>
