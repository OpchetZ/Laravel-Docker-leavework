@php
    // $employ = $employs->where('status_id', '!=','3')

@endphp


<div class="form-group {{ $errors->has('employ_id') ? 'has-error' : ''}}">
    <label for="employ_id" class="control-label">{{ 'รายชื่อ' }}</label>
    {{-- <input class="form-control"style="border-radius: 12px" name="employ_id" type="number" id="employ_id" value="{{ isset($leavebalance->employ_id) ? $leavebalance->employ_id : ''}}" > --}}
    <select class="form-select" name="employ_id" id="employ_id" required>
        <option value="">รายชื่อ</option>
        @foreach($employs as $item)
        <option value="{{ $item->id }}">{{ $item->name }}/{{ $item->status->status_name }}</option>
        @endforeach
    </select>
    <script>
        document.querySelector('#employ_id').value = "{{ isset($leavebalance->employ_id) ? $leavebalance->employ_id : ''}}";
    </script>
    {!! $errors->first('employ_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
    <label for="year" class="control-label">{{ 'ปี' }}</label>
    <input class="form-control" name="year"style="border-radius: 12px" type="number" id="year" value="{{ isset($leavebalance->year) ? $leavebalance->year : ''}}" >
    {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vacation_leave') ? 'has-error' : ''}}">
    <label for="vacation_leave" class="control-label">{{ 'วันลาปีนี้' }}</label>
    <div id="vacation_leave_con">
    <input class="form-control"style="border-radius: 12px" name="vacation_leave" type="number" id="vacation_leave" value="{{ isset($leavebalance->vacation_leave) ? $leavebalance->vacation_leave : ''}}" >
    </div>
    {!! $errors->first('vacation_leave', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vacation_carried') ? 'has-error' : ''}}">
    <label for="vacation_carried" class="control-label">{{ 'วันลาสะสม *(ใส่ตามวันที่เหลือจากปีที่แล้ว)' }}</label>
    <div id="vacation_carried_con">
    <input class="form-control"style="border-radius: 12px" name="vacation_carried" type="number" id="vacation_carried" value="{{ isset($leavebalance->vacation_carried) ? $leavebalance->vacation_carried : ''}}" >
    </div>
    {!! $errors->first('vacation_carried', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('max_carry') ? 'has-error' : ''}}">
    <label for="max_carry" class="control-label">{{ 'วันลาสะสมสูงสุด' }}</label>
    <div id="max_carry_con">
    <input class="form-control"style="border-radius: 12px" name="max_carry" type="number" id="max_carry" value="{{ isset($leavebalance->max_carry) ? $leavebalance->max_carry : ''}}" >
    </div>
    {!! $errors->first('max_carry', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('is_eligible') ? 'has-error' : ''}}">
    <label for="is_eligible" class="control-label">{{ 'สิทธิ์ในการลาสะสม' }}</label>
    <div class="radio">
    <label><input name="is_eligible"style="border-radius: 12px" type="radio" id="eligible_yes" value="1" {{ (isset($leavebalance) && 1 == $leavebalance->is_eligible) ? 'checked' : '' }}> มีสิทธิ์</label>
</div>
<div class="radio">
    <label><input name="is_eligible"style="border-radius: 12px" type="radio" id="eligible_no" value="0" @if (isset($leavebalance)) {{ (0 == $leavebalance->is_eligible) ? 'checked' : '' }} @else {{ 'checked' }} @endif> ไม่มีสิทธิ์</label>
</div>
    {!! $errors->first('is_eligible', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group" style="margin-top: 10px">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
<script>
    document.addEventListener('DOMContentLoaded', function (){
        const NameInput = document.getElementById('employ_id');
        const YearInput = document.getElementById('year');
        const VacationLeaveInput = document.getElementById('vacation_leave_con');
        const VacationCarryInput = document.getElementById('vacation_carried_con');
        const MaxCarryInput = document.getElementById('max_carry_con');
        const employeeStatusIdMap = @json($employs->pluck('status_id', 'id'));
       

        function realcalculeave() {
            
        }
   function calculeave() {
    const selectedId = this.value;
    const statusId = employeeStatusIdMap[selectedId]; 
    if (statusId == 1) {
        renderInputVacacarry(0);
        renderInputThisVaca(10);
        renderInputMax(20)
       
    }else if (statusId == 2) {
        renderInputVacacarry(0);
        renderInputThisVaca(10);
        renderInputMax(5)
    } else if (statusId == 3){
        renderInputVacacarry(0);
        renderInputThisVaca(10);
        renderInputMax(0)
    }
    else if (statusId == 6){
        renderInputVacacarry(0);
        renderInputThisVaca(10);
        renderInputMax(20)
    }
    else if (statusId == 7){
        renderInputVacacarry(0);
        renderInputThisVaca(10);
        renderInputMax(5)
    }
}
function renderInputVacacarry(value) {
    VacationCarryInput.innerHTML = `<input class="form-control"style="border-radius: 12px" name="vacation_carried" type="number" id="vacation_carried" value="${value}" >
`;
}
function renderInputThisVaca(value) {
    VacationLeaveInput.innerHTML = `<input class="form-control"style="border-radius: 12px" name="vacation_leave" type="number" id="vacation_leave" value="${value}" >
`;
}
function renderInputMax(value) {
    MaxCarryInput.innerHTML = `<input class="form-control"style="border-radius: 12px" name="max_carry" type="number" id="max_carry" value="${value}" >
`;
}
NameInput.addEventListener('change', calculeave);


});
</script>