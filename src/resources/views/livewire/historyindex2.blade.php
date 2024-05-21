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
                                $filteredLeaveRequests = $leaverequest->whereIn('employ_id', $list);
                                $filteredem = $employs->whereIn('agent_id', $agenlist);
                                $totalvaca = $leaverequest->whereIn('employ_id',$list)->whereIn('leave_type_id','1')->sum('total_leave');
                                $totalbus = $leaverequest->whereIn('employ_id',$list)->whereIn('leave_type_id','2')->sum('total_leave');
                                $totalsick = $leaverequest->whereIn('employ_id',$list)->whereIn('leave_type_id','4')->sum('total_leave');
                            @endphp
                            <div class="col-lg-3">
                                <form action="{{ url('/history') }}" method="GET">
                                    <select class="form-select" name="agen" id="agen" wire:model="agenlist"
                                        required>
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
                                <select class="form-select" name="employ" id="employ" wire:model="list" required>
                                    <option value="">รายชื่อ</option>
                                    @foreach ($filteredem as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <script>
                                    document.querySelector("#employ").value = "{{ request('employ') ? request('employ') : '' }}";
                                </script>
                            </div>
                        </div>
                    </div>

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                   
                                    <th>ชื่อพนักงาน</th>
                                    <th>ประเภทการลา</th>
                                    <th>วันเริ่ม</th>
                                    <th>วันสิ้นสุด</th>
                                    <th>วัน</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list != null)
                                
                                    @foreach ($filteredLeaveRequests as $leaveRequest)
                                        <tr>
                                            
                                            <td>{{ $leaveRequest->employ->name }}</td>
                                            <td>{{ $leaveRequest->leavetype->leave_type_name }}</td>
                                            <td>{{ $leaveRequest->start_date->thaidate('วันที่ j M พ.ศ. y') }}</td>
                                            <td>{{ $leaveRequest->end_date->thaidate('วันที่ j M พ.ศ. y') }}</td>
                                            <td>{{ $leaveRequest->total_leave }}</td>

                                            <td>
                                                <a href="{{ url('/leaverequest/' . $leaveRequest->id) }}"
                                                    title="View leaverequest"><button class="btn btn-info btn-sm"><i
                                                            class="fa fa-eye" aria-hidden="true"></i> ดู</button></a>



                                                <form method="POST"
                                                    action="{{ url('/leaverequest' . '/' . $leaveRequest->id) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete leaverequest"
                                                        onclick="return confirm('Confirm delete?')"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i>
                                                        ลบ</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <td><b>ลาพักผ่อน {{ $totalvaca }} </b></td>
                                    <td><b>ลากิจ {{ $totalbus }}</b></td>
                                    <td><b>ลาป่วย {{ $totalsick }}</b></td>
                                @else
                                @endif
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
