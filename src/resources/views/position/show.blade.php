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
                    {{-- <div class="card-header">position {{ $position->id }}</div> --}}
                    <div class="card-body">

                        <a href="{{ url('/position') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> กลับ</button></a>
                        <a href="{{ url('/position/' . $position->id . '/edit') }}" title="Edit position"><button
                                class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                แก้ไข</button></a>

                        <form method="POST" action="{{ url('position' . '/' . $position->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete position"
                                onclick="return confirm('ลบ?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                ลบ</button>
                        </form>
                        <br />
                        <br />

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $position->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> ตำแหน่ง </th>
                                        <td> {{ $position->Job_position }} </td>
                                    </tr>
                                    {{-- <tr>
                                        <th>โควต้าการลา</th>
                                        <td> {{ $postion->Max_leave }} </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
