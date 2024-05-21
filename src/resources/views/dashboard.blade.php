<x-app-layout title="ลางาน">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('หน้าแรก') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        {{-- <div class="col-lg-5"> --}}
                            <a href="{{ url('/leaverequest/create') }}" class="btn btn-success btn-lg"
                                title="Add New leaverequest" style="font-size: 50px">
                                <i class="fa fa-plus" aria-hidden="true"></i> กรอกใบลา
                            </a>
                            
                        {{-- </div> --}}
                    </div> 
                    
                    <div class="row mt-3">
                        <div class="col-lg-5">
                           
                            <a href="{{ url('/leaverequest') }}" class="btn btn-primary btn-lg"
                                title="last leaverequest" style="font-size: 50px">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> ใบลาล่าสุด
                            </a>

                        </div>
                       
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-5">
                           
                            <a href="{{ url('/history') }}" class="btn btn-warning btn-lg"
                                title="history" style="font-size: 50px">
                                <i class="fa fa-archive" aria-hidden="true"></i> ประวัติการลา
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
