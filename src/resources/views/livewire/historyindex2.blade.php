<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <a href="{{ url('/dashboard') }}" class="btn btn-warning btn-sm"
                                    title="Add New leaverequest">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> หน้าแรก
                                </a>
                            </div>
                            @php
                                $filteredLeaveRequests = $leaverequest
                                    ->whereIn('employ_id', $list)
                                    ->whereIn('status', 'อนุมัติ');

                                $oneem = $employs->whereIn('id', $list);
                                $peremploy = $employs->whereIn('id', $list);
                                $filteredem = $employs->whereIn('agent_id', $agenlist);
                                $agencyy = $agen->whereIn('id', $agenlist);

                                // $totalvaca = $leaverequest
                                //     ->whereIn('employ_id', $list)
                                //     ->whereIn('leave_type_id', '1')
                                //     ->whereIn('status', 'อนุมัติ')
                                //     ->sum('total_leave');
                                // $totalbus = $leaverequest
                                //     ->whereIn('employ_id', ${data.id})
                                //     ->whereIn('leave_type_id', '2')
                                //     ->whereIn('status', 'อนุมัติ')
                                //     ->sum('total_leave');
                                // $totalsick = $leaverequest
                                //     ->whereIn('employ_id', ${data.id})
                                //     ->whereIn('leave_type_id', '4')
                                //     ->whereIn('status', 'อนุมัติ')
                                //     ->sum('total_leave');

                            @endphp
                            <div class="col-lg-3">
                                <form action="{{ url('/history') }}" method="GET">
                                    {{-- <select class="form-select" name="agen" id="agen" wire:model="agenlist" required> --}}
                                    <select class="form-select" name="agen" id="agen" required>
                                        <option value="">หน่วยงาน</option>
                                        @foreach ($agen as $item)
                                            <option value="{{ $item->id }}">{{ $item->agency_name }}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        document.querySelector("#agen").value = "{{ request('agen') ? request('agen') : '' }}";
                                    </script>
                                </form>
                            </div>
                            <div class="col-lg-3">
                                {{-- <select class="form-select" name="employeeId" id="employ" wire:model="list" required> --}}
                                <select class="form-select" name="employeeId" id="employ" required>
                                    <option value="">รายชื่อ</option>

                                </select>

                                <script>
                                    document.querySelector("#employ").value = "{{ request('employ') ? request('employ') : '' }}";
                                </script>
                            </div>

                            <div class="col-lg-3">
                                <select name="yearre" id="yearre" required
                                    style="border: 1px solid #ced4da;border-radius: .375rem;">
                                    <option value="">ปีรายงาน</option>
                                    @for ($year = date('Y'); $year > date('Y') - 2; $year--)
                                        <option value="{{ $year }}">
                                            {{ $year + 543 }}
                                        </option>
                                    @endfor
                                </select>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        document.getElementById('agen').addEventListener('change', function() {
                                            const agencyId = this.value;
                                            const employeeSelect = document.getElementById('employ');

                                            // เคลียร์ค่าเก่าออกก่อน
                                            employeeSelect.innerHTML = '<option value="">กำลังโหลด...</option>';

                                            if (agencyId) {
                                                fetch(`/get-employees/${agencyId}`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        employeeSelect.innerHTML = '<option value="">เลือกรายชื่อพนักงาน</option>';
                                                        data.forEach(employee => {
                                                            const option = document.createElement('option');
                                                            option.value = employee.id;
                                                            option.textContent = employee.name;
                                                            employeeSelect.appendChild(option);
                                                        });
                                                    })
                                                    .catch(error => {
                                                        console.error("เกิดข้อผิดพลาด:", error);
                                                        employeeSelect.innerHTML = '<option value="">โหลดข้อมูลล้มเหลว</option>';
                                                    });
                                            } else {
                                                employeeSelect.innerHTML = '<option value="">เลือกรายชื่อพนักงาน</option>';
                                            }
                                        });
                                    });
                                </script>

                                <a href="" id="reportLink" title="PDF">
                                    <button class="btn btn-success btn-sm" id="printReportBtn">
                                        <i class="fa fa-file" aria-hidden="true"> พิมพ์รายงาน</i>
                                    </button>
                                </a>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    document.getElementById('printReportBtn').addEventListener('click', function(event) {
                                        event.preventDefault();

                                        const yearSelect = document.getElementById('yearre');
                                        if (!yearSelect) {
                                            console.error("Dropdown ปีไม่พบ!");
                                            return;
                                        }

                                        const selectedYear = yearSelect.value;

                                        if (selectedYear) {
                                            const startYear = parseInt(selectedYear);
                                            const startDate = `${startYear}-10-01`;
                                            const endDate = `${startYear + 1}-09-30`;

                                            const reportUrl = `/history/report?start_date=${startDate}&end_date=${endDate}`;

                                            console.log("Redirecting to: ", reportUrl);
                                            window.location.href = reportUrl;
                                        } else {
                                            alert('กรุณาเลือกปีรายงานก่อนพิมพ์รายงาน');
                                        }
                                    });
                                });
                            </script>




                        </div>
                    </div>

                    <br />
                    <br />

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const observer = new MutationObserver(() => {
                                const perreportButton = document.getElementById('perreport');
                                if (perreportButton) {
                                    console.log("✅ ปุ่ม perreport ถูกสร้างแล้ว!");
                                    perreportButton.addEventListener('click', function(event) {
                                        event.preventDefault();
                                        console.log("✅ ปุ่ม perreport ถูกกด!");

                                        const selectedYearper = document.getElementById('yearre')?.value;
                                        const employeeId = document.getElementById('employ')?.value;

                                        if (!selectedYearper || !employeeId) {
                                            alert('กรุณาเลือกปีรายงานและพนักงานก่อนพิมพ์รายงาน');
                                            return;
                                        }

                                        const startYearper = parseInt(selectedYearper, 10);
                                        if (isNaN(startYearper)) {
                                            console.error("❌ ปีไม่ถูกต้อง:", selectedYearper);
                                            alert("เกิดข้อผิดพลาด: ปีไม่ถูกต้อง");
                                            return;
                                        }

                                        const startDateper = `${startYearper}-10-01`;
                                        const endDateper = `${startYearper + 1}-09-30`;

                                        const perreportUrl =
                                            `/history/perreport/${employeeId}?start_date=${startDateper}&end_date=${endDateper}`;
                                        console.log("🚀 Redirecting to: ", perreportUrl);
                                        window.location.href = perreportUrl;
                                    });
                                }
                            });

                            observer.observe(document.body, {
                                childList: true,
                                subtree: true
                            });
                        });
                    </script>
                    {{-- @php
                        $start_date1 = $YEAR 
                        $end_date1 = $YEAR
                        
                        $totalsick1 = $leaverequest
                            ->where('status', 'อนุมัติ')
                            ->whereBetween('start_date', [$start_date1, $end_date1])
                            ->where('leave_type_id', 4)
                            ->sum('total_leave');
                        $totalbus1 = $leaverequest
                            ->where('status', 'อนุมัติ')
                            ->where('leave_type_id', 2)
                            ->sum('total_leave');
                        $totalvaca1 = $leaverequest
                            ->where('status', 'อนุมัติ')
                            ->where('leave_type_id', 1)
                            ->sum('total_leave');
                        
                    @endphp --}}
                    {{-- <select name="yearper" id="yearper" wire:model="YEAR" required style="border: 1px solid #ced4da;border-radius: .375rem;">
                        <option value="">ปีรายงาน</option>
                        @for ($year = date('Y'); $year > date('Y') - 2; $year--)
                            <option value="{{ $year }}">
                                {{ $year + 543 }}
                            </option>
                        @endfor
                    </select> --}}
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            document.getElementById('employ').addEventListener('change', function() {
                                const employeeId = this.value;
                                const employeeTable = document.getElementById('employee-details');

                                // เคลียร์ข้อมูลเก่า
                                employeeTable.innerHTML = "<tr><td colspan='2'>กำลังโหลดข้อมูล...</td></tr>";

                                if (employeeId) {
                                    fetch(`/get-employee-details/${employeeId}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.error) {
                                                employeeTable.innerHTML =
                                                    `<tr><td colspan='2' class='text-danger'>${data.error}</td></tr>`;
                                            } else {
                                                employeeTable.innerHTML = `
                                                
                                                <a href="" id="perlink" title="PDF">
                            
                                <button class="btn btn-success btn-sm" id="perreport">
                                    <i class="fa fa-file" aria-hidden="true"> พิมพ์รายบุคคล</i>
                                </button>
                            </a>
                                                <table class="table">
                    <tbody>
                                                     <tr><th> ชื่อพนักงาน </th><td> ${data.name}</td> </tr>
                                                    <tr> <th> หน่วยงาน </th><td> ${data.agency} </td></tr>
                                                    <tr><th> ประเภทการจ้าง </th><td> ${data.status} </td></tr>
                                                    </tbody>
                                                    </table>
                                                    <table class="tsize">
                    <tr>
                        <th> ประเภทการลา </th>
                        <td> ลาพักผ่อน </td>
                        <td> ลากิจ </td>
                        <td> ลาป่วย </td>
                    </tr>
                    <tr>
                        <th> สิทธิการลา(วัน) </th>
                        <td> ${data.vaca_max} </td>
                        <td> ${data.bus_max} </td>
                        <td> ${data.sick_max} </td>
                    </tr>
                    
                </table>
                                                   
                                                `;
                                            }
                                        })
                                        .catch(error => {
                                            console.error("เกิดข้อผิดพลาด:", error);
                                            employeeTable.innerHTML =
                                                `<tr><td colspan='2' class='text-danger'>โหลดข้อมูลล้มเหลว</td></tr>`;
                                        });
                                } else {
                                    employeeTable.innerHTML = `<tr><td colspan='2'>กรุณาเลือกพนักงาน</td></tr>`;
                                }
                            });
                        });
                    </script>
                   
                    <script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('yearre').addEventListener('change', function() {
        updateLeaveData();
    });

    function updateLeaveData() {
        const employeeId = document.getElementById('employ')?.value;
        const selectedYear = document.getElementById('yearre')?.value || "";

        console.log("📌 Employee ID:", employeeId);
        console.log("📌 Selected Year:", selectedYear);

        if (!employeeId) return;
        const startYear = parseInt(selectedYear);
        const startDate = `${startYear}-10-01`;
        const endDate = `${startYear + 1}-09-30`;
        fetch(`/get-leave-details/${employeeId}?start_date=${startDate}&end_date=${endDate}`)
            .then(response => response.json())
            .then(data => {
                console.log("📌 API Response:", data); // Debug ดูค่าที่ API ส่งมา
                document.getElementById('leave-details').innerHTML = `
                    <table class="table tsize">
                        <tr>
                            <th class="leave-details"> จำนวนวันลา </th>
                            <td> ${data.total_vaca} </td>
                            <td> ${data.total_bus} </td>
                            <td> ${data.total_sick} </td>
                            
                        </tr>
                        <tr>
                            <th class="leave-details"> วันลาคงเหลือ </th>
                            <td> ${data.remain_vaca} </td>
                            <td> ${data.remain_bus} </td>
                            <td> ${data.remain_sick} </td>
                            
                        </tr>
                       
                    </table>
                `;
            })
            .catch(error => {
                console.error("❌ เกิดข้อผิดพลาด:", error);
                document.getElementById('leave-details').innerHTML =
                    `<tr><td colspan='3' class='text-danger'>โหลดข้อมูลล้มเหลว</td></tr>`;
            });
    }
});
                    //     document.addEventListener("DOMContentLoaded", function() {
                    //         document.getElementById('employ').addEventListener('change', function() {
                    //             const employeeId = this.value;
                    //             const leaveTable = document.getElementById('leave-details');

                                


                    //             if (employeeId) {
                    //                 fetch(`/get-leave-details/${employeeId}`)
                    //                     .then(response => response.json())
                    //                     .then(data => {
                    //                         leaveTable.innerHTML = `
                    //                         <table class="table tsize">
                    //                                 <tr>    
                    //                                 <th class="leave-details"> จำนวนวันลา </th>
                    //                                 <td> ${data.total_vaca} </td>
                    //                                 <td> ${data.total_bus} </td>
                    //                                 <td> ${data.total_sick} </td>
                    //                             </tr>
                    // </table>
                                                
                    //                         `;
                    //                     })
                    //                     .catch(error => {
                    //                         console.error("เกิดข้อผิดพลาด:", error);
                    //                         leaveTable.innerHTML =
                    //                             `<tr><td colspan='3' class='text-danger'>โหลดข้อมูลล้มเหลว</td></tr>`;
                    //                     });
                    //             } else {

                    //             }
                    //         });
                    //     });
                    </script>

                    <div class="table-responsive bigTmar thth" id="employee-details">

                    </div>
                    <div id="leave-details" class="thth">
                        
                             
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
