<x-app-layout title="พนักงาน">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('พนักงาน') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Employ</div> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <a href="{{ url('/employ/create') }}" class="btn btn-success btn-sm"
                                    title="Add New employ">
                                    <i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <form method="GET" action="{{ url('/employ') }}" accept-charset="UTF-8"
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
                        </div>

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>เบอร์โทร</th>
                                        <th>ตำแหน่ง</th>
                                        <th>สถาณะ</th>
                                        <th>หน่วยงาน</th>
                                        <th>วันหยุดสะสม</th>
                                        <th>ลาพักผ่อน</th>
                                        <th>ลากิจ</th>
                                        <th>ลาป่วย</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>                               
                                    @foreach ($employ as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name??null }}</td>
                                            <td>{{ $item->phone??null }}</td> 
                                            <td>{{ $item->position->Job_position??null }}</td>
                                            <td>{{ $item->status->status_name??null }}</td>
                                            <td>{{ $item->agency->agency_name??null }}</td>
                                            <td>{{ $item->Acc_vaca_day }}</td>
                                            <td>{{ $item->vaca_max }}</td>
                                            <td>{{ $item->bus_max }}</td>
                                            <td>{{ $item->sick_max }}</td>
                                            <td>
                                                <a href="{{ url('/employ/' . $item->id) }}" title="View employ"><button
                                                        class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i> ดู</button></a>
                                                <a href="{{ url('/employ/' . $item->id . '/edit') }}"
                                                    title="Edit employ"><button class="btn btn-primary btn-sm"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        แก้ไข</button></a>

                                                <form method="POST" action="{{ url('/employ' . '/' . $item->id) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete employ"
                                                        onclick="return confirm('Confirm delete?')"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> ลบ</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $employ->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
