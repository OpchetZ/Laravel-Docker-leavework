<x-app-layout title="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Leavebalance {{ $leavebalance->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/leavebalance') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/leavebalance/' . $leavebalance->id . '/edit') }}" title="Edit Leavebalance"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('leavebalance' . '/' . $leavebalance->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Leavebalance" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $leavebalance->id }}</td>
                                    </tr>
                                    <tr><th> Employ Id </th><td> {{ $leavebalance->employ_id }} </td></tr><tr><th> Year </th><td> {{ $leavebalance->year }} </td></tr><tr><th> Vacation Leave </th><td> {{ $leavebalance->vacation_leave }} </td></tr><tr><th> Vacation Carried </th><td> {{ $leavebalance->vacation_carried }} </td></tr><tr><th> Max Carry </th><td> {{ $leavebalance->max_carry }} </td></tr><tr><th> Is Eligible </th><td> {{ $leavebalance->is_eligible }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>