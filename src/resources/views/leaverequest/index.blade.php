<x-app-layout title="ใบลา">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ใบลา') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Leaverequest</div> --}}
                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="col-lg-9">
                                <a href="{{ url('/leaverequest/create') }}" class="btn btn-success btn-sm"
                                    title="Add New leaverequest">
                                    <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มใบลา
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <form method="GET" action="{{ url('/leaverequest') }}" accept-charset="UTF-8"
                                    class="form-inline my-2 my-lg-0 float-right" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Search..." value="{{ request('search') }}">
                                        <span class="input-group-append">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div> --}}

                        {{-- <br />
                        <br /> --}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th>ชื่อพนักงาน</th>
                                        <th>ประเภทการลา</th>
                                        <th>วันเริ่ม</th>
                                        <th>วันสิ้นสุด</th>
                                        <th>วัน</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                      $leaverequest = $leaverequest->first()  
                                    @endphp

                                    @if($leaverequest != null)
                                    {{-- @foreach ($leaverequest as $item) --}}
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $leaverequest->employ->name }}</td>
                                            <td>{{ $leaverequest->leavetype->leave_type_name }}</td>
                                            <td>{{ $leaverequest->start_date->thaidate('วันที่ j M พ.ศ. y') }}</td>
                                            <td>{{ $leaverequest->end_date->thaidate('วันที่ j M พ.ศ. y') }}</td>
                                            <td>{{ $leaverequest->total_leave }}</td>
                                            <td>
                                                {{-- <a href="{{ url('/leaverequest/' . $leaverequest->id) }}"
                                                    title="View leaverequest"><button class="btn btn-info btn-sm"><i
                                                            class="fa fa-eye" aria-hidden="true"></i> ดู</button></a> --}}
                                                <a href="{{ url('/leaverequest/' . $leaverequest->id . '/edit') }}"
                                                    title="Edit leaverequest"><button class="btn btn-primary btn-sm"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        แก้ไข</button></a>
                                                <a href="{{ url('/leaverequest/' . $leaverequest->id . '/pdf') }}"
                                                    title="PDF">
                                                    <button class="btn btn-success btn-sm">
                                                        <i class="fa fa-file" aria-hidden="true"> พิมพ์ใบลา</i> 
                                                    </button>
                                                </a>


                                                <form method="POST"
                                                    action="{{ url('/leaverequest' . '/' . $leaverequest->id) }}"
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
                                    {{-- @endforeach --}}
                                    @endif
                                </tbody>
                            </table>
                            {{-- <div class="pagination-wrapper"> {!! $leaverequest->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
