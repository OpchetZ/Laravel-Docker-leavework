<x-report-pdf title="">

    <body>
        @php

            $start = \Carbon\Carbon::parse(request('start_date'))->startOfDay();
            $end = \Carbon\Carbon::parse(request('end_date'))->endOfDay();
            $year = $start->year + 543;
            $em1 = $employs->where('status_id', 1);
            $em2 = $employs->where('status_id', 2);
            $em3 = $employs->where('status_id', 3);
        @endphp
        <div>
            <div class="text-center head">
                <div>สรุปวันลาหน่วยงาน ศูนย์ผ้าและซักฟอก </div>
                <div>ตั้งแต่วันที่ 1 ตุลาคม {{ $year }} ถึงวันที่ 30 กันยายน {{ $year + 1 }}</div>

            </div>
            {{-- <div class="row text-center">
                <div class="col-xs-2">รายชื่อ</div>
                <div class="col-xs-2">ลาป่วย</div>
                <div class="col-xs-2">ลากิจ</div>
                <div class="col-xs-2">ลาพักผ่อน</div>
                <div class="col-xs-2">รวมวันลาทั้งหมด</div>

            </div> --}}

            <table class="cen">
                <thead>
                    <tr class="bor">
                        <td class="col-lg-6 bor">ที่</td>
                        <td class="col-lg-6 bor">ชื่อ</td>
                        <td class="col-lg-6 bor">ตำแหน่ง</td>
                        <td class="col-lg-4 bor">สะสม</td>
                        <td class="col-lg-6 bor">ลาพักผ่อน</td>
                        <td class="col-lg-6 bor">ลากิจ</td>
                        <td class="col-lg-6 bor">ลาป่วย</td>

                    </tr>
                </thead>

                <tbody>
                    <tr class="bor">
                        <td class="col-lg-6 bor">#</td>
                        <td class="col-lg-6 bor">ประเภทการจ้าง:ลูกจ้างประจำ</td>
                        <td class="col-lg-6 bor">สิทธิการลา(วัน)</td>
                        <td class="col-lg-4 bor"></td>
                        <td class="col-lg-6 bor text-center">10</td>
                        <td class="col-lg-6 bor text-center">45</td>
                        <td class="col-lg-6 bor text-center">60</td>

                    </tr>
                    @foreach ($em1 as $item)
                        <tr class="bor">
                            <td class="bor text-center">{{ $loop->iteration }}</td>
                            <td class="bor">{{ $item->name }}</td>
                            <td class="bor">{{ $item->position->Job_position }}</td>
                            <td class="text-center bor">{{$balance[$item->id]->vacation_carried}}</td>
                            <td class="text-center bor">
                               
                                @php
                                $vaca = $item->leaverequests
                                    ->where('leave_type_id', 1)
                                    ->whereBetween('start_date', [$start, $end])
                                    ->sum('total_leave');

                            @endphp

                            {{ $vaca }}

                            </td>
                            <td class="text-center bor">
                                @php
                                    $bus = $item->leaverequests
                                        ->where('leave_type_id', 2)
                                        ->whereBetween('start_date', [$start, $end])
                                        ->sum('total_leave');

                                @endphp

                                {{ $bus }}
                            </td>
                            <td class="text-center bor">
                               
                                @php

                                $sickleave = $item->leaverequests
                                    ->where('leave_type_id', 4)
                                    ->whereBetween('start_date', [$start, $end])
                                    ->sum('total_leave');

                            @endphp

                            {{ $sickleave }}
                            </td>

                        </tr>
                    @endforeach

                    <tr class="bor">
                        <td class="col-lg-6 bor">#</td>
                        <td class="col-lg-6 bor">ประเภทการจ้าง:พนักงานกระทรวงฯ</td>
                        <td class="col-lg-6 bor">สิทธิการลา(วัน)</td>
                        <td class="col-lg-4 bor"></td>
                        <td class="col-lg-6 bor text-center">10</td>
                        <td class="col-lg-6 bor text-center">15</td>
                        <td class="col-lg-6 bor text-center">45</td>

                    </tr>
                    @foreach ($em2 as $item)
                        <tr class="bor">
                            <td class="bor text-center">{{ $loop->iteration }}</td>
                            <td class="bor">{{ $item->name }}</td>
                            <td class="bor">{{ $item->position->Job_position }}</td>
                            <td class="text-center bor">{{$balance[$item->id]->vacation_carried}}</td>
                            <td class="text-center bor">
                                @php

                                    $vaca = $item->leaverequests
                                        ->where('leave_type_id', 1)
                                        ->whereBetween('start_date', [$start, $end])
                                        ->sum('total_leave');

                                @endphp

                                {{ $vaca }}

                            </td>
                            <td class="text-center bor">
                                @php
                                    $bus = $item->leaverequests
                                        ->where('leave_type_id', 2)
                                        ->whereBetween('start_date', [$start, $end])
                                        ->sum('total_leave');

                                @endphp

                                {{ $bus }}
                            </td>
                            <td class="text-center bor">
                                @php
                                    $sickleave = $item->leaverequests
                                        ->where('leave_type_id', 4)
                                        ->whereBetween('start_date', [$start, $end])
                                        ->sum('total_leave');

                                @endphp

                                {{ $sickleave }}
                            </td>

                        </tr>
                    @endforeach
                    <tr class="bor">
                        <td class="col-lg-6 bor">#</td>
                        <td class="col-lg-6 bor">ประเภทการจ้าง:ลูกจ้าวชั่วคราว (รายวัน)</td>
                        <td class="col-lg-6 bor">สิทธิการลา(วัน)</td>
                        <td class="col-lg-4 bor"></td>
                        <td class="col-lg-6 bor text-center">10</td>
                        <td class="col-lg-6 bor text-center">0</td>
                        <td class="col-lg-6 bor text-center">15</td>

                    </tr>
                    @foreach ($em3 as $item)
                        <tr class="bor">
                            <td class="bor text-center">{{ $loop->iteration }}</td>
                            <td class="bor">{{ $item->name }}</td>
                            <td class="bor">{{ $item->position->Job_position }}</td>
                            <td class="text-center bor">{{$balance[$item->id]->vacation_carried}}</td>
                            <td class="text-center bor">
                                @php

                                    $vaca = $item->leaverequests
                                        ->where('leave_type_id', 1)
                                        ->whereBetween('start_date', [$start, $end])
                                        ->sum('total_leave');

                                @endphp

                                {{ $vaca }}

                            </td>
                            <td class="text-center bor">
                                @php
                                    $bus = $item->leaverequests
                                        ->where('leave_type_id', 2)
                                        ->whereBetween('start_date', [$start, $end])
                                        ->sum('total_leave');

                                @endphp

                                {{ $bus }}
                            </td>
                            <td class="text-center bor">
                                @php
                                    $sickleave = $item->leaverequests
                                        ->where('leave_type_id', 4)
                                        ->whereBetween('start_date', [$start, $end])
                                        ->sum('total_leave');

                                @endphp

                                {{ $sickleave }}
                            </td>

                        </tr>
                    @endforeach
                    {{-- <tr class="text-center">
                        @php
                            $totalsick = $leaverequest
                                ->where('status', 'อนุมัติ')
                                ->where('leave_type_id', 4)
                                ->filter(function ($leave) use ($start, $end) {
                                    return \Carbon\Carbon::parse($leave->start_date)->between($start, $end);
                                })
                                ->sum('total_leave');
                            $totalbus = $leaverequest
                                ->where('status', 'อนุมัติ')
                                ->where('leave_type_id', 2)
                                ->filter(function ($leave) use ($start, $end) {
                                    return \Carbon\Carbon::parse($leave->start_date)->between($start, $end);
                                })
                                ->sum('total_leave');
                            $totalvaca = $leaverequest
                                ->where('status', 'อนุมัติ')
                                ->where('leave_type_id', 1)
                                ->filter(function ($leave) use ($start, $end) {
                                    return \Carbon\Carbon::parse($leave->start_date)->between($start, $end);
                                })
                                ->sum('total_leave');
                            $totalall = $totalsick + $totalbus + $totalvaca;
                        @endphp
                        <td class="bor">#</td>
                        <td class="bor">วันลาโดยรวม</td>
                        <td class="bor">{{ $totalsick }}</td>
                        <td class="bor">{{ $totalvaca }}</td>
                        <td class="bor">{{ $totalbus }}</td>
                        <td class="bor">{{ $totalall }}</td>
                    </tr> --}}
                </tbody>

            </table>

        </div>
    </body>
</x-report-pdf>
