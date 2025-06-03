<div class="row">
    <div class="col-xs-5">
        <div>{{ $leaverequest->employ->status->status_name }}</div>
    </div>
    <br>
    <div class="col-xs-6 text-right">
        <div>เขียนที่ โรงพยาบาลอ่างทอง</div>
        <div>{{ $leaverequest->created_at->thaidate('วันที่ j เดือน F พ.ศ. y') }}</div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <div>
            <span> เรื่อง </span>
            <span> ขอ{{ $leaverequest->leavetype->leave_type_name }} </span>
        </div>
        <div>
            <span> เรียน </span>
            <span> ผู้อำนวยการโรงพยาบาลอ่างทอง </span>
        </div>
    </div>
</div>
@php
    $currentYear = Carbon::parse($leaverequest->start_date->toDateString())->year;
$startOfFiscalYear = Carbon::create($currentYear, 10, 1)->toDateString();
$endOfFiscalYear = Carbon::create($currentYear + 1, 9, 30)->toDateString();
    $selectedIds = [$leaverequest->employ_id];
    $selectleave = [$leaverequest->leave_type_id];
    if ($leaverequest->leavetype->leave_type_name == 'ลากิจ') {
        $leavebus = $leaverequest
            ->whereIn('employ_id', $selectedIds)
            ->whereIn('leave_type_id', $selectleave)
            ->whereBetween('start_date', [$startOfFiscalYear, $endOfFiscalYear])
            ->sum('total_leave');
        $busleave = $leaverequest->total_leave;
        $leavebus = $leavebus - $leaverequest->total_leave;
        $allleave = $leavebus + $leaverequest->total_leave;
    } elseif ($leaverequest->leavetype->leave_type_name == 'ลาป่วย') {
        $leavesick = $leaverequest
            ->whereIn('employ_id', $selectedIds)
            ->whereIn('leave_type_id', $selectleave)
            ->whereBetween('start_date', [$startOfFiscalYear, $endOfFiscalYear])
            ->sum('total_leave');
        $sickleave = $leaverequest->total_leave;
        $leavesick = $leavesick - $leaverequest->total_leave;
        $sickallleave = $leavesick + $leaverequest->total_leave;
    } else {
        $leavevaca = $leaverequest
            ->whereIn('employ_id', $selectedIds)
            ->whereIn('leave_type_id', $selectleave)
            ->sum('total_leave');
        $elsleave = $leaverequest->total_leave;
        $leavevaca = $leavevaca - $leaverequest->total_leave;
        $ealleave = $leavevaca + $leaverequest->total_leave;
    }
    $lastdate = $leaverequest
        ->whereIn('employ_id', $selectedIds)
        ->whereIn('leave_type_id', $selectleave)
        ->skip(1)
        ->latest()
        ->first();
@endphp
<div class="container">
    <div class="">
        <div class="dis1">ข้าพเจ้า </div>
        <div class="dis">{{ $leaverequest->employ->name }}</div>
        <div class="dis2"> ตำแหน่ง </div>
        <div class="dis3">{{ $leaverequest->employ->position->Job_position }}</div>
        <div class="dot3">........................................................</div>
        <div class="dot4">.......................................................</div>
    </div>
    <span>สังกัด...........โรงพยาบาลอ่างทอง.....................กลุ่มงาน............{{ $leaverequest->employ->agency->agency_name }}........................</span>
    <div style="text-align: left;"><span class="tab2">ขอ
            {{ $leaverequest->leavetype->leave_type_name }}</span><span>เนื่องจาก
            {{ $leaverequest->reason }}</span></div>
    <span
        id="">ตั้งแต่วันที่..........................ถึงวันที่..........................มีกำหนด {{ $leaverequest->total_leave }} วัน</span>
        <div class="startdate">{{ $leaverequest->start_date->thaidate('j M y') }}</div>
    <div class="enddate">{{ $leaverequest->end_date->thaidate('j M y') }}</div>
     <br>
    <span>ข้าพเจ้าได้ {{ $leaverequest->leavetype->leave_type_name }}
        ครั้งสุดท้ายตั้งแต่
        {{ $lastdate ? $lastdate->start_date->thaidate('วันที่ j M y') : '......................' }}
        ถึงวันที่{{ $lastdate ? $lastdate->end_date->thaidate(' j M y ') : '.....................' }}</span><span>รวม
        {{ $lastdate->total_leave ?? '...' }} วัน
        ในระหว่างการลาติดต่อข้าพเจ้าได้ที่...............................................................................</span>
    <br>
    <span>..........................................................หมายเลขโทรศัพท์.............{{ $leaverequest->employ->phone }}..............</span>
</div>

<div class="row">
    <div class="col-xs-6"></div>
    <div class="col-xs-6">
        <span> ขอแสดงความนับถือ</span><br><br>
        <div class="dis">ลงชื่อ................................<div class="dissignn">{{ $leaverequest->employ->sign }}
        </div></div><br>
        <div class="dissign1">({{ $leaverequest->employ->name }})</div>
    </div>
</div>
<div class="row">
    <div>
        <div class="text-left">
            <span>สถิติการลาในปีงบประมาณนี้</span>
        </div>
        <div class="row text-center">
            <div class="col-xs-3 b">ประเภท<br>การลา </div>
            <div class="col-xs-3 b">ลามาแล้ว<br>(วันทำการ)</div>
            <div class="col-xs-3 b">ลาครั้งนี้<br>(วันทำการ)</div>
            <div class="col-xs-3 b">รวมเป็น<br>(วันทำการ)</div>
            {{-- <div class="col-xs-4 text-center"><span>
                    (นายยุทธนา เกษมสุข)<br>เจ้าพนักงานธุรการปฎิบัติงาน</span></div> --}}
        </div>
        <div class="row text-center">
            <div class="col-xs-4 b">ป่วย</div>
            <div class="col-xs-4 b">{{ $leavesick ?? null }}<br></div>
            <div class="col-xs-4 b">{{ $sickleave ?? null }}<br></div>
            <div class="col-xs-4 b">{{ $sickallleave ?? null }}<br></div>


        </div>
        <div class="row text-center">
            <div class="col-xs-4 b">กิจส่วนตัว</div>
            <div class="col-xs-4 b">{{ $leavebus ?? null }}<br></div>
            <div class="col-xs-4 b">{{ $busleave ?? null }}<br></div>
            <div class="col-xs-4 b">{{ $allleave ?? null }}<br></div>


        </div>
    </div>



</div>
<div class="row">
    <div class="col-xs-6"></div>
    <div class="col-xs-6">
        <span> ความเห็นผู้บังคับบัญชา</span><br>
        <span>.........................................................</span> <br>
        <span>.........................................................</span> <br>
        <div class="dis">ลงชื่อ <div class="dissign1">(นายยุทธนา เกษมสุข)</div>
        </div><br>
        <span>ตำแหน่ง เจ้าพนักงานธุรการปฎิบัติงาน </span> <br>
        <span>วันที่.................................................</span>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">

        <span>ลงชื่อ.....................................ผู้ตรวจสอบ</span> <br>
        <span>ตำแหน่ง...........................................</span> <br>
        <span>วันที่.................................................</span>
    </div>
    <div class="col-xs-6">
        <span> คำสั่ง ( ) อนุญาต ( ) ไม่อนุญาต</span><br>
        <span>.........................................................</span> <br>
        <div class="dis">ลงชื่อ <div class="dissign2">(นางพลับพลึง จำพรด)</div> </div><br>
        <span>ตำแหน่ง รองผู้อำนวยการฝ่ายบริหาร</span><br><div class="posi">ปฏิบัติราชการแทนผู้อำนวยการโรงพยาบาลอ่างทอง</div> <br>
        <span>วันที่.................................................</span>
    </div>
</div>
<div class="dondelete1">หมายเหตุ : ห้ามลบขีดเขียน</div>