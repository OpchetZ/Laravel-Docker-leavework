<x-report-pdf title="">

    <body>
        @php
            $filteredLeaveRequests = $leaverequest->whereIn('employ_id', $employs->id)->whereIn('status', 'อนุมัติ');

            $totalvaca = $leaverequest
                ->whereIn('employ_id', $employs->id)
                ->whereIn('leave_type_id', '1')
                ->whereIn('status', 'อนุมัติ')
                ->sum('total_leave');
            $totalbus = $leaverequest
                ->whereIn('employ_id', $employs->id)
                ->whereIn('leave_type_id', '2')
                ->whereIn('status', 'อนุมัติ')
                ->sum('total_leave');
            $totalsick = $leaverequest
                ->whereIn('employ_id', $employs->id)
                ->whereIn('leave_type_id', '4')
                ->whereIn('status', 'อนุมัติ')
                ->sum('total_leave');
            
            $allleave = $totalvaca + $totalbus + $totalsick;

            $start = \Carbon\Carbon::parse(request('start_date'))->startOfDay();
            $end = \Carbon\Carbon::parse(request('end_date'))->endOfDay();
            $year = $start->year + 543;
        @endphp
        <div id="namereport">สรุปวันลา หน่วยงาน {{$employs->agency->agency_name}}</div>
        <div id="namereport">ชื่อ-นามสกุล {{$employs->name}}</div>
        <div id="namereport">ประเภทการจ้าง:{{ $employs->status->status_name }}</div>
        <div id="namereport">ตั้งแต่วันที่ 1 ตุลาคม {{ $year }} ถึงวันที่ 30 กันยายน {{ $year + 1 }} </div>
            <table class="cen">
                <thead>
                    <tr class="bor text-center">

                        <td>ที่</td>
                        <td>ตั้งแต่วันที่</td>
                        <td>ถึงวันที่</td>
                        <td>ลาพักผ่อน({{ $employs->vaca_max }})</td>
                        <td>ลากิจ({{ $employs->bus_max }})</td>
                        <td>ลาป่วย({{ $employs->sick_max }})</td>
                        
                    </tr>
                </thead>
                <tbody>
                    



                    @foreach ($filteredLeaveRequests as $leaveRequest)
                        <tr>
                            
                           <td class="text-center">{{ $loop->iteration }}</td>
                            
                            <td>{{ $leaveRequest->start_date->thaidate('วันที่ j F พ.ศ. Y') }}</td>
                            <td>{{ $leaveRequest->end_date->thaidate('วันที่ j F พ.ศ. Y') }}</td>
                            @if ($leaveRequest->leave_type_id == 1)
                            <td class="text-center">{{ $leaveRequest->total_leave}}</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            @elseif ($leaveRequest->leave_type_id == 2)
                            <td class="text-center">0</td>
                            <td class="text-center">{{ $leaveRequest->total_leave}}</td>
                            <td class="text-center">0</td>
                            @elseif ($leaveRequest->leave_type_id == 4)
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">{{ $leaveRequest->total_leave}}</td>
                            @endif
                            
                            


                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center">รวม</td>
                        <td class="text-center">{{ $totalvaca }}</td>
                        <td class="text-center">{{ $totalbus }}</td>
                        <td class="text-center">{{ $totalsick }}</td>
                         


                     </tr>
                     <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center">วันลาคงเหลือ</td>
                        <td class="text-center">{{ $employs->vaca_max-$totalvaca }}</td>
                        <td class="text-center">{{ $employs->bus_max-$totalbus }}</td>
                        <td class="text-center">{{ $employs->sick_max-$totalsick }}</td>
                         


                     </tr>
                
                </tbody>
            </table>
          
    </body>
</x-report-pdf>
