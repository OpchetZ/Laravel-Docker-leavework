<x-boost-pdf title="">

    <body style="font-size:<?php echo $leaverequest->leavetype->leave_type_name == 'ลาพักผ่อน' ? '15px' : '15px'; ?>;">
        <div class="container" style="margin-left: 75px;">
            @if ($leaverequest->leavetype->leave_type_name == 'ลาพักผ่อน')
                <div class="row">
                    <div class="col-xs-5">
                        <div>{{ $leaverequest->employ->status->status_name }}</div>
                    </div>
                    <br>
                    <div class="col-xs-6 text-right">
                        <div>เขียนที่ โรงพยาบาลอ่างทอง</div>
                        <div>{{ $leaverequest->start_date->thaidate('วันที่ j เดือน F พ.ศ. y') }}</div>
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
                    $selectedIds = [$leaverequest->employ_id];
                    $selectleave = [$leaverequest->leave_type_id];
                    $leavevaca = $leaverequest
                        ->whereIn('employ_id', $selectedIds)
                        ->whereIn('leave_type_id', $selectleave)
                        ->sum('total_leave');
                    $leavevaca = $leavevaca - $leaverequest->total_leave;
                    $allleave = $leavevaca + $leaverequest->total_leave;
                    $accleave = $leaverequest->employ->vaca_max - $leavevaca;
                    $accday = $leaverequest->employ->Acc_vaca_day;
                    $vacatotal = $accday + $accleave;
                    if ($accday != 0) {
                        if ($allleave > $leaverequest->employ->vaca_max) {
                            $odd = $allleave - $leaverequest->employ->vaca_max;
                            $odd = $odd - $leaverequest->total_leave;
                            $accday = $leaverequest->employ->Acc_vaca_day - $odd;

                            $accleave = 0;
                            $vacatotal = $accday + $accleave;
                        }
                    } elseif ($accleave > 0) {
                        $accday = 0;
                        $accleave = $leaverequest->employ->vaca_max - $leavevaca;
                        $vacatotal = $accday + $accleave;
                    }
                @endphp
                <div class="container">
                    <div class="">
                        <span id="nam">ข้าพเจ้า {{ $leaverequest->employ->name }} </span><span id="posi"> ตำแหน่ง
                            {{ $leaverequest->employ->position->Job_position }}</span>
                    </div>
                    <span>สังกัด...........โรงพยาบาลอ่างทอง...........................กลุ่มงาน.............{{ $leaverequest->employ->agency->agency_name }}.........</span>
                    <span>มีวันลาพักผ่อนสะสม {{ $accday }} วันทำการมีสิทธิลาพักผ่อนประจำปีนี้อีก
                        {{ $accleave }} วันทำการ รวมเป็น {{ $vacatotal }} วัน<br></span>
                    <span>ขอลาพักผ่อนตั้งแต่ {{ $leaverequest->start_date->thaidate('วันที่ j เดือน M พ.ศ. y') }}
                        ถึงวันที่{{ $leaverequest->end_date->thaidate('j เดือน Mพ.ศ. y') }}
                    </span>
                    <span>มีกำหนด{{ $leaverequest->total_leave }}วัน
                        ในระหว่างการลาติดต่อข้าพเจ้าได้ที่.......................................................................................</span>
                    <span>..........................................................หมายเลขโทรศัพท์.............{{ $leaverequest->employ->phone }}......................</span>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6">
                        <span> ขอแสดงความนับถือ</span><br>
                        <span>ลงชื่อ.................................</span><br>
                        <span>({{ $leaverequest->employ->name }})</span>
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
                            <div class="col-xs-6 text-center"><span>
                                    (นายยุทนา เกษมสุข)<br>เจ้าพนักงานธุรการปฎิบัติงาน</span></div>
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
                        <span>ลงชื่อ (นางพลับพลึง จำพรด) </span><br>
                        <span>ตำแหน่ง หัวหน้ากลุ่มงานบริหารทั่วไป </span> <br>
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
                        <span>ลงชื่อ (นางวราภรณ์ วังเมธากุล) </span><br>
                        <span>ตำแหน่ง รองผู้อำนวยการฝ่ายบริหาร </span> <br>
                        <span>วันที่.................................................</span>
                    </div>
                </div>
                <span>หมายเหตุ : ห้ามลบขีดเขียน</span>
            @else
                <div class="row">
                    <div class="col-xs-5">
                        <div>{{ $leaverequest->employ->status->status_name }}</div>
                    </div>
                    <br>
                    <div class="col-xs-6 text-right">
                        <div>เขียนที่ โรงพยาบาลอ่างทอง</div>
                        <div>{{ $leaverequest->start_date->thaidate('วันที่ j เดือน F พ.ศ. y') }}</div>
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
                    $selectedIds = [$leaverequest->employ_id];
                    $selectleave = [$leaverequest->leave_type_id];
                    if ($leaverequest->leavetype->leave_type_name == 'ลากิจ') {
                        $leavebus = $leaverequest
                            ->whereIn('employ_id', $selectedIds)
                            ->whereIn('leave_type_id', $selectleave)
                            ->sum('total_leave');
                        $busleave = $leaverequest->total_leave;
                        $leavebus = $leavebus - $leaverequest->total_leave;
                        $allleave = $leavebus + $leaverequest->total_leave;
                    } elseif ($leaverequest->leavetype->leave_type_name == 'ลาป่วย') {
                        $leavesick = $leaverequest
                            ->whereIn('employ_id', $selectedIds)
                            ->whereIn('leave_type_id', $selectleave)
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
                        <span id="nam">ข้าพเจ้า {{ $leaverequest->employ->name }} </span><span id="posi"> ตำแหน่ง
                            {{ $leaverequest->employ->position->Job_position }}</span>
                    </div>
                    <span>สังกัด...........โรงพยาบาลอ่างทอง.....................กลุ่มงาน............{{ $leaverequest->employ->agency->agency_name }}..........</span>
                    <div style="text-align: center;">ขอ {{ $leaverequest->leavetype->leave_type_name }}
                        เนื่องจาก {{ $leaverequest->reason }}</div>
                    <span>ตั้งแต่{{ $leaverequest->start_date->thaidate('วันที่ j เดือน M พ.ศ y') }} ถึงวันที่
                        {{ $leaverequest->end_date->thaidate('j เดือน M พ.ศ y') }}
                        มีกำหนด {{ $leaverequest->total_leave }} วัน</span> <br>
                    <span>ข้าพเจ้าได้ {{ $leaverequest->leavetype->leave_type_name }}
                        ครั้งสุดท้ายตั้งแต่{{ $lastdate ? $lastdate->start_date->thaidate('วันที่ j เดือน M พ.ศ y') : '......................' }}ถึงวันที่
                        {{ $lastdate ? $lastdate->end_date->thaidate('j เดือน M พ.ศ y') : '.....................' }}</span><br>
                    <span>รวม{{ $lastdate->total_leave ?? '...' }}วัน
                        ในระหว่างการลาติดต่อข้าพเจ้าได้ที่...............................................................................</span>
                    <br>
                    <span>..........................................................หมายเลขโทรศัพท์.............{{ $leaverequest->employ->phone }}............................</span>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6">
                        <span> ขอแสดงความนับถือ</span><br>
                        <span>ลงชื่อ.................................</span><br>
                        <span>({{ $leaverequest->employ->name }})</span>
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
                        </div>
                        <div class="row text-center">
                            <div class="col-xs-4 b">ป่วย</div>
                            <div class="col-xs-4 b">{{ $leavesick ?? null }}<br></div>
                            <div class="col-xs-4 b">{{ $sickleave ?? null }}<br></div>
                            <div class="col-xs-4 b">{{ $sickallleave ?? null }}<br></div>
                            <div class="col-xs-6 text-center"><span>
                                    (นายยุทนา เกษมสุข)</span></div>
                        </div>
                        <div class="row text-center">
                            <div class="col-xs-4 b">กิจส่วนตัว</div>
                            <div class="col-xs-4 b">{{ $leavebus ?? null }}<br></div>
                            <div class="col-xs-4 b">{{ $busleave ?? null }}<br></div>
                            <div class="col-xs-4 b">{{ $allleave ?? null }}<br></div>
                            <div class="col-xs-6 text-center"><span>
                                    เจ้าพนักงานธุรการปฎิบัติงาน</span></div>

                        </div>
                    </div>



                </div>
                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6">
                        <span> ความเห็นผู้บังคับบัญชา</span><br>
                        <span>.........................................................</span> <br>
                        <span>ลงชื่อ (นางพลับพลึง จำพรด) </span><br>
                        <span>ตำแหน่ง หัวหน้ากลุ่มงานบริหารทั่วไป </span> <br>
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
                        <span>ลงชื่อ (นางวราภรณ์ วังเมธากุล) </span><br>
                        <span>ตำแหน่ง รองผู้อำนวยการฝ่ายบริหาร </span> <br>
                        <span>วันที่.................................................</span>
                    </div>
                </div>
                <span>หมายเหตุ : ห้ามลบขีดเขียน</span>
            @endif
        </div>
    </body>
    </x-bootstrap-pdf>
