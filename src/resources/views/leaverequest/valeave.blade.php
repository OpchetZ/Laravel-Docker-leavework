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
   use Carbon\Carbon;
    use App\Models\LeaveRequest;


$currentYear = Carbon::parse($leaverequest->start_date->toDateString())->year;
$DateofBalance = Carbon::parse($leaverequest->start_date->toDateString());
if ($DateofBalance->month >= 10) {
    $fiscalYEAR = $DateofBalance->year + 1;
}else {
    $fiscalYEAR = $DateofBalance->year;
}
$startOfFiscalYear = Carbon::create($currentYear - 1, 10, 1);
    $endOfFiscalYear = Carbon::create($currentYear, 9, 30);
    $startOfFiscalYear2 = Carbon::create($currentYear, 10, 1);
    $endOfFiscalYear2 = Carbon::create($currentYear + 1, 9, 30);
if ($leaverequest->start_date->between($startOfFiscalYear,$endOfFiscalYear)) {
     $selectedIds = [$leaverequest->employ_id];
    $selectleave = [$leaverequest->leave_type_id];
    $balance = $leavebalance
        ->whereIn('employ_id', $selectedIds)
        ->whereIn('year', $fiscalYEAR);
    $leavevaca = $leaverequest
        ->whereIn('employ_id', $selectedIds)
        ->whereIn('leave_type_id', $selectleave)
        ->where('id', '<=', $leaverequest->id)
        ->whereBetween('start_date', [$startOfFiscalYear, $endOfFiscalYear])
        ->sum('total_leave');
    $leavevaca = ($leavevaca - $leaverequest->total_leave); 
    $allleave = ($leavevaca + $leaverequest->total_leave); 
    // $accleave = ($balance->firstWhere('year', $currentYear)->vacation_leave - $leavevaca);
    // $accday = ($balance->firstWhere('year', $currentYear)->vacation_carried); 
    

    if ($balance->firstWhere('year',$fiscalYEAR)->is_eligible == 1) {
       $accday = ($balance->firstWhere('year', $fiscalYEAR)->vacation_carried - $leavevaca);
        $accleave = ($balance->firstWhere('year', $fiscalYEAR)->vacation_leave);
        
         if ($accday < 0) {
            $accleave += $accday;
            $accday = 0;
        }
        $vacatotal = $accday + $accleave;
    } elseif ($balance->firstWhere('year',$fiscalYEAR)->is_eligible == 0) {
    $accleave = ($balance->firstWhere('year', $fiscalYEAR)->vacation_leave - $leavevaca);
    $accday = ($balance->firstWhere('year', $fiscalYEAR)->vacation_carried);
    $vacatotal = $accday + $accleave;
    }
}elseif ($leaverequest->start_date->between($startOfFiscalYear2,$endOfFiscalYear2)) {
    $selectedIds = [$leaverequest->employ_id];
    $selectleave = [$leaverequest->leave_type_id];
     $balance = $leavebalance
        ->whereIn('employ_id', $selectedIds)
        ->whereIn('year', $fiscalYEAR);
    $leavevaca = $leaverequest
        ->whereIn('employ_id', $selectedIds)
        ->whereIn('leave_type_id', $selectleave)
        ->where('id', '<=', $leaverequest->id)
        ->whereBetween('start_date', [$startOfFiscalYear2, $endOfFiscalYear2])
        ->sum('total_leave');
    $leavevaca = ($leavevaca - $leaverequest->total_leave); 
    $allleave = ($leavevaca + $leaverequest->total_leave); 
    
     
    

    if ($balance->firstWhere('year',$fiscalYEAR)->is_eligible == 1) {
       $accday = ($balance->firstWhere('year', $fiscalYEAR)->vacation_carried - $leavevaca);
        $accleave = ($balance->firstWhere('year', $fiscalYEAR)->vacation_leave);
        
        if ($accday < 0) {
            $accleave += $accday;
            $accday = 0;
        }
        $vacatotal = $accday + $accleave;
    } elseif ($balance->firstWhere('year',$fiscalYEAR)->is_eligible == 0) {
    $accleave = ($balance->firstWhere('year', $fiscalYEAR)->vacation_leave - $leavevaca);
    $accday = ($balance->firstWhere('year', $fiscalYEAR)->vacation_carried);
    $vacatotal = $accday + $accleave;
    }
}

   
@endphp

<div class="container">
    <div class="">
        <div class="dis1">ข้าพเจ้า </div>
        <div class="dis">{{ $leaverequest->employ->name }}</div>
        <div class="dis2"> ตำแหน่ง </div>
        <div class="dis3">{{ $leaverequest->employ->position->Job_position }}</div>
        <div class="dot">.................................................</div>
        <div class="dot2">..................................................</div>
    </div>
    <span>สังกัด...........โรงพยาบาลอ่างทอง...........................กลุ่มงาน.............{{ $leaverequest->employ->agency->agency_name }}.....</span>
    <span>มีวันลาพักผ่อนสะสม {{ $accday }} วันทำการมีสิทธิลาพักผ่อนประจำปีนี้อีก
        {{ $accleave }} วันทำการรวมเป็น{{ $vacatotal }} วัน<br></span>
    <span>ขอลาพักผ่อนตั้งแต่วันที่..............................................ถึงวันที่..............................................
    </span>
    <div class="vacadatestart">{{ $leaverequest->start_date->thaidate('j เดือน M พ.ศ.y') }}</div>
    <div class="vacadateend">{{ $leaverequest->end_date->thaidate('j เดือน M พ.ศ.y') }}</div>
    <br>
    <span>มีกำหนด..{{ $leaverequest->total_leave }}..วัน
        ในระหว่างการลาติดต่อข้าพเจ้าได้ที่..........................................................</span>
    <span>..........................................................หมายเลขโทรศัพท์.............{{ $leaverequest->employ->phone }}....................</span>
</div>

<div class="row">
    <div class="col-xs-6"></div>
    <div class="col-xs-6">
        <span> ขอแสดงความนับถือ</span><br><br>
        <div class="dis">ลงชื่อ................................<div class="dissign">{{ $leaverequest->employ->sign }}
            </div></div><br>
        <div class="dissign1">({{ $leaverequest->employ->name }})</div>
    </div>

</div>
<div class="row">
    <div>
        <div class="text-left">
            <span>สถิติการลาในงบปีนี้</span>
        </div>
        <div class="row">
            <div class="col-xs-4 b">ลามาแล้ว<br>(วันทำการ)</div>
            <div class="col-xs-4 b">ลาครั้งนี้<br>(วันทำการ)</div>
            <div class="col-xs-4 b">รวมเป็น<br>(วันทำการ)</div>
            {{-- <div class="col-xs-6 text-center"><span>
                    (นายยุทธนา เกษมสุข)<br>เจ้าพนักงานธุรการปฎิบัติงาน</span></div> --}}
        </div>
        <div class="row text-center">
            <div class="col-xs-4 b"> {{ $leavevaca }} <br></div>
            <div class="col-xs-4 b">{{ $leaverequest->total_leave }}<br> </div>
            <div class="col-xs-4 b">{{ $allleave }}<br></div>
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
        <span>ตำแหน่ง เจ้าพนักงานธุรการชำนาญงาน </span> <br>
        <span>วันที่.................................................</span>
    </div>
</div>
<div class="approveva">เห็นควรอนุญาต</div>
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

