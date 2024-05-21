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
                    {{-- <div class="card-header">leaverequest {{ $leaverequest->id }}</div> --}}
                    <div class="card-body">
                        
                        <a href="{{ url('/history') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/leaverequest/' . $leaverequest->id . '/edit') }}"
                            title="Edit leaverequest"><button class="btn btn-primary btn-sm"><i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข</button></a>
                        <a href="{{ url('/leaverequest/' . $leaverequest->id . '/pdf') }}" title="PDF">
                            <button class="btn btn-success btn-sm">
                                <i class="fa fa-file" aria-hidden="true"></i> พิมพ์ใบลา
                            </button>
                        </a>
                        {{-- <form action="{{route('history.index', $leaverequest->id)}}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-sm" ><i class="fas fa-save">บันทึก </i></button></a>
                          </form> --}}

                        <form method="POST" action="{{ url('leaverequest' . '/' . $leaverequest->id) }}"
                            accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete leaverequest"
                                onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o"
                                    aria-hidden="true"></i> Delete</button>
                        </form>
                        <br />
                        <br />

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    {{-- <tr>
                                        <th>ID</th>
                                        <td>{{ $leaverequest->id }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th> ชื่อพนักงาน </th>
                                        <td> {{ $leaverequest->employ->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> ประเภทการลา </th>
                                        <td> {{ $leaverequest->leavetype->leave_type_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> วันเริ่ม </th>
                                        <td> {{ $leaverequest->start_date->thaidate('วันที่ j เดือน F พ.ศ. y') }} </td>
                                    </tr>
                                    <tr>
                                        <th> วันสิ้นสุด </th>
                                        <td> {{ $leaverequest->end_date->thaidate('วันที่ j เดือน F พ.ศ. y') }} </td>
                                    </tr>
                                    <tr>
                                        <th> วัน </th>
                                        <td> {{ $leaverequest->total_leave }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
