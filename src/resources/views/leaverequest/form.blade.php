{{-- <div class="form-group {{ $errors->has('employ_id') ? 'has-error' : ''}}">
    <label for="employ_id" class="control-label">{{ 'Employ Id' }}</label>
    <input class="form-control" style="border-radius: 12px" name="employ_id" type="number" id="employ_id" value="{{ isset($leaverequest->employ_id) ? $leaverequest->employ_id : ''}}" >
    {!! $errors->first('employ_id', '<p class="help-block">:message</p>') !!}
</div> --}}
<div class="form-group {{ $errors->has('employ_id') ? 'has-error' : ''}}">
    <label for="post_id" class="control-label">{{ 'ชื่อพนักงาน' }}</label>
    {{-- <input class="form-control" style="border-radius: 12px" name="post_id" type="number" id="post_id" value="{{ isset($employ->post_id) ? $employ->post_id : ''}}" > --}}
    <select class="form-select" name="employ_id" id="employ_id" required>
        <option value="">รายชื่อ</option>
        @foreach($employs as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <script>
        document.querySelector("#employ_id").value = "{{ isset($leaverequest->employ_id) ? $leaverequest->employ_id : ''}}";
        
    </script>
    {!! $errors->first('post_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('leave_type_id') ? 'has-error' : ''}}">
    <label for="leave_type_id" class="control-label">{{ 'ประเภทการลา' }}</label>
    <select name="leave_type_id" class="form-control" id="leave_type_id" required>
        @foreach($leavetype as $item)
        <option value="{{ $item->id }}">{{ $item->leave_type_name }}</option>
        @endforeach
</select>
<script>
    document.querySelector("#leave_type_id").value = "{{ isset($leaverequest->leave_type_id) ? $leaverequest->leave_type_id : ''}}";
</script>
    {!! $errors->first('leave_type_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reason') ? 'has-error' : ''}}">
    <label for="reason" class="control-label">{{ 'เนื่องจาก' }}</label>
    <textarea class="form-control" rows="5" name="reason" type="textarea" id="reason" value="{{ isset($leaverequest->reason) ? $leaverequest->reason : ''}}"></textarea>
    {!! $errors->first('reason', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    <label for="start_date" class="control-label">{{ 'วันเริ่ม' }}</label>
    <input class="form-control" style="border-radius: 12px" name="start_date" type="date" id="start_date" value="{{ isset($leaverequest->start_date) ? date('Y-m-d',strtotime($leaverequest->start_date)) : ''}}" >
    {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
    <label for="end_date" class="control-label">{{ 'วันสิ้นสุด' }}</label>
    <input class="form-control" style="border-radius: 12px" name="end_date" type="date" id="end_date" value="{{ isset($leaverequest->end_date) ? date('Y-m-d', strtotime($leaverequest->end_date)) : '' }}" >
    {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total_leave') ? 'has-error' : ''}}">
    <label for="total_leave" class="control-label">{{ 'จำนวนวัน' }}</label>
    <div id="total_leave_container">
        <input class="form-control" style="border-radius: 12px" name="total_leave" type="number" step="0.1" id="total_leave" value="{{ isset($leaverequest->total_leave) ? $leaverequest->total_leave : ''}}" >
    </div>
    {!! $errors->first('total_leave', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'สถาณะ' }}</label>
    <select name="status" class="form-control" id="status" required>
        <option value="รอการอนุมัติ">รอการอนุมัติ</option>
        <option value="อนุมัติ">อนุมัติ</option>
        <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
</select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
<script>
    document.querySelector("#status").value = "{{ isset($leaverequest->status) ? $leaverequest->status : ''}}";
</script>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const totalLeaveContainer = document.getElementById('total_leave_container');

        
        function calculateTotalLeave() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            
            if (!isNaN(startDate) && !isNaN(endDate) && startDate.toDateString() === endDate.toDateString()) {
                renderSelectOption();
            } else if (!isNaN(startDate) && !isNaN(endDate) && startDate <= endDate) {
                const timeDifference = endDate - startDate;
                const totalDays = timeDifference / (1000 * 60 * 60 * 24) + 1;
                renderInputField(totalDays);
            } else {
                renderInputField(''); 
            }
        }

       
        function renderSelectOption() {
            totalLeaveContainer.innerHTML = `
                <select class="form-control" style="border-radius: 12px" name="total_leave" id="total_leave">
                    <option value="1">หนึ่งวัน</option>
                    <option value="0.5">ครึ่งวัน</option>
                </select>
            `;
        }

        
        function renderInputField(value) {
            totalLeaveContainer.innerHTML = `
                <input class="form-control" style="border-radius: 12px" name="total_leave" type="number" step="0.1" id="total_leave" value="${value}">
            `;
        }

        
        startDateInput.addEventListener('change', calculateTotalLeave);
        endDateInput.addEventListener('change', calculateTotalLeave);
    });
</script>


<div class="form-group" style="margin-top: 10px">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
