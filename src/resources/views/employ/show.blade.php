<x-app-layout title="พนักงาน">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">employ {{ $employ->id }}</div> --}}
                    <div class="card-body">

                        <a href="{{ url('/employ') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> กลับ</button></a>
                        <a href="{{ url('/employ/' . $employ->id . '/edit') }}" title="Edit employ"><button
                                class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Edit</button></a>

                        <form method="POST" action="{{ url('employ' . '/' . $employ->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete employ"
                                onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o"
                                    aria-hidden="true"></i> Delete</button>
                        </form>
                        <br />
                        <br />

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    
                                    <tr>
                                        <th> ชื่อ-นามสกุล </th>
                                        <td> {{ $employ->name??null }} </td>
                                    </tr>
                                    <tr>
                                        <th> โทรศัพท์ </th>
                                        <td> {{ $employ->phone??null }} </td>
                                    </tr>
                                    <tr>
                                        <th> สถาณะ </th>
                                        <td> {{ $employ->status->status_name??null }} </td>
                                    </tr>
                                    <tr>
                                        <th> ตำแหน่ง </th>
                                        <td> {{ $employ->position->Job_position??null }} </td>
                                    </tr>
                                    <tr>
                                        <th>หน่วยงาน</th>
                                        <td> {{ $employ->agency->agency_name??null }} </td>
                                    </tr>
                                    {{-- <tr>
                                        <th> วันลาสะสม </th>
                                        <td> {{ $employ->Acc_vaca_day }} </td>
                                    </tr>
                                    <tr>
                                        <th> ลาพักผ่อน </th>
                                        <td> {{ $employ->vaca_max }} </td>
                                    </tr>
                                    <tr>
                                        <th> ลากิจ </th>
                                        <td> {{ $employ->bus_max }} </td>
                                    </tr>
                                    <tr>
                                        <th> ลาป่วย </th>
                                        <td> {{ $employ->sick_max }} </td>
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
