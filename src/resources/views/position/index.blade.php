<x-app-layout title="ตำแหน่ง">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ตำแหน่ง') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Position</div> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <a href="{{ url('/position/create') }}" class="btn btn-success btn-sm" title="Add New position">
                                    <i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <form method="GET" action="{{ url('/position') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                        <span class="input-group-append">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>ตำแหน่ง</th><th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($position as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->Job_position }}</td>
                                        {{-- <td>{{ $item->Max_leave }}</td> --}}
                                        <td>
                                            {{-- <a href="{{ url('/position/' . $item->id) }}" title="View position"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> ดู</button></a> --}}
                                            <a href="{{ url('/position/' . $item->id . '/edit') }}" title="Edit position"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข</button></a>

                                            <form method="POST" action="{{ url('/position' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete position" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> ลบ</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $position->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>