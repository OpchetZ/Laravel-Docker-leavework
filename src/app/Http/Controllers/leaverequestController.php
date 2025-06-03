<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\agency;
use App\Models\employ;
use App\Models\history;
use App\Models\leaverequest;
use App\Models\leavetype;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class leaverequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = 25;

        $leaverequest = leaverequest::latest()->paginate($perPage);
        return view('leaverequest.index', compact('leaverequest'));
    }
    public function index2(Request $request)
    {


        $employs = employ::get();
        $agen = agency::get();
        $leaverequest = leaverequest::get();




        return view('leaverequest.index2', compact('employs', 'agen', 'leaverequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $employs = employ::get();
        $leavetype = leavetype::get();
        return view('leaverequest.create', compact('employs', 'leavetype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        leaverequest::create($requestData);

        return redirect('leaverequest')->with('flash_message', 'leaverequest added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $leaverequest = leaverequest::findOrFail($id);

        return view('leaverequest.show', compact('leaverequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $leaverequest = leaverequest::findOrFail($id);
        $employs = employ::get();
        $leavetype = leavetype::get();
        return view('leaverequest.edit', compact('leaverequest', 'employs', 'leavetype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $leaverequest = leaverequest::findOrFail($id);
        $leaverequest->update($requestData);

        return redirect('leaverequest')->with('flash_message', 'leaverequest updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        leaverequest::destroy($id);

        return redirect('leaverequest')->with('flash_message', 'leaverequest deleted!');
    }
    public function pdf($id)
    {
        ini_set('max_execution_time', '300');
        
        $leaverequest = leaverequest::findOrFail($id);
        
        // $startdate = Carbon::parse('2024-04-23')->thaidate('วันที่ j เดือน F พ.ศ. y');
        $employs = employ::get();
        $pdf = Pdf::loadView('leaverequest.pdf', compact('leaverequest', 'employs'));
        return $pdf->stream("leaverequest-{$id}.pdf");
    }
    public function report(Request $request)
    {
        ini_set('max_execution_time', '300');
        $start_date = Carbon::parse($request->start_date)->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();

        $leaverequest = leaverequest::with('employ')
        ->whereBetween('start_date', [$start_date, $end_date])
        ->get();
        
        $employs = employ::with('position')->get();
        $pdf = Pdf::loadView('leaverequest.report', compact('leaverequest', 'employs', 'start_date', 'end_date'));
        return $pdf->stream("leaverequest.report");
    }
    public function perreport(Request $request, $id)
    {
        ini_set('max_execution_time', '300');
        if (!$request->has('start_date') || !$request->has('end_date')) {
            return redirect()->back()->with('error', 'กรุณาเลือกปี');
        }
        $start_date = Carbon::parse($request->start_date)->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();
        $leaverequest = leaverequest::with('employ')
        ->whereBetween('start_date', [$start_date, $end_date])
        ->get();


        // $startdate = Carbon::parse('2024-04-23')->thaidate('วันที่ j เดือน F พ.ศ. y');
        $employs = employ::findOrFail($id);
        $pdf = Pdf::loadView('leaverequest.perreport', compact('leaverequest', 'employs','start_date','end_date'));
        return $pdf->stream("leaverequest.perreport");
    }
    public function getEmployees($agencyId)
{
    // ดึงข้อมูลพนักงานที่อยู่ในหน่วยงานที่เลือก
    $employees = employ::where('agent_id', $agencyId)->get();

    // ส่งข้อมูลกลับเป็น JSON ให้ JavaScript ใช้
    return response()->json($employees);
}
public function getEmployeeDetails($id)
{
    $employee = employ::with('status', 'agency')->find($id);

    if (!$employee) {
        return response()->json(['error' => 'ไม่พบพนักงาน'], 404);
    }
    // $totalVaca = leaverequest::where('employ_id', $id)
    //     ->where('leave_type_id', 1)
    //     ->where('status', 'อนุมัติ')
    //     ->sum('total_leave');

    // $totalBus = leaverequest::where('employ_id', $id)
    //     ->where('leave_type_id', 2)
    //     ->where('status', 'อนุมัติ')
    //     ->sum('total_leave');

    // $totalSick = leaverequest::where('employ_id', $id)
    //     ->where('leave_type_id', 4)
    //     ->where('status', 'อนุมัติ')
    //     ->sum('total_leave');

    return response()->json([
        'id' => $employee->id,
        'name' => $employee->name,
        'agency' => $employee->agency->agency_name ?? 'ไม่มีข้อมูล',
        'status' => $employee->status->status_name ?? 'ไม่มีข้อมูล',
        'sick_max' => $employee->sick_max,
        'bus_max' => $employee->bus_max,
        'vaca_max' => $employee->vaca_max,
        // 'total_vaca' => $totalVaca,
        // 'total_bus' => $totalBus,
        // 'total_sick' => $totalSick,
    ]);
}
public function getLeaveDetails(Request $request, $id)
{
    
    

    
        $start_date = Carbon::create($request->start_date)->startOfDay();
        $end_date = Carbon::create($request->end_date)->endOfDay();
    
    $totalVaca = leaverequest::where('employ_id', $id)
        ->whereBetween('start_date', [$start_date, $end_date])
        ->where('leave_type_id', 1)
        ->where('status', 'อนุมัติ')
        ->sum('total_leave');

    $totalBus = leaverequest::where('employ_id', $id)
        ->whereBetween('start_date', [$start_date, $end_date])
        ->where('leave_type_id', 2)
        ->where('status', 'อนุมัติ')
        ->sum('total_leave');

    $totalSick = leaverequest::where('employ_id', $id)
        ->whereBetween('start_date', [$start_date, $end_date])
        ->where('leave_type_id', 4)
        ->where('status', 'อนุมัติ')
        ->sum('total_leave');
   $VACAMAX = employ::where('id', $id)->value('vaca_max');
   $BUSMAX = employ::where('id', $id)->value('bus_max');  
   $SickMAX = employ::where('id', $id)->value('sick_max');

   $remainVaca = $VACAMAX - $totalVaca;
   $remainBus = $BUSMAX - $totalBus;
    $remainSick = $SickMAX - $totalSick;

    
       
    

    return response()->json([
        'total_vaca' => $totalVaca,
        'total_bus' => $totalBus,
        'total_sick' => $totalSick,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'remain_vaca' => $remainVaca,
        'remain_bus' => $remainBus,
        'remain_sick' => $remainSick,
        
    ]);
}

// public function getLeaveDetails($id)
// {
//     $totalVaca = leaverequest::where('employ_id', $id)
//         ->where('leave_type_id', 1)
//         ->where('status', 'อนุมัติ')
//         ->sum('total_leave');

//     $totalBus = leaverequest::where('employ_id', $id)
//         ->where('leave_type_id', 2)
//         ->where('status', 'อนุมัติ')
//         ->sum('total_leave');

//     $totalSick = leaverequest::where('employ_id', $id)
//         ->where('leave_type_id', 4)
//         ->where('status', 'อนุมัติ')
//         ->sum('total_leave');

//     return response()->json([
//         'total_vaca' => $totalVaca,
//         'total_bus' => $totalBus,
//         'total_sick' => $totalSick,
//     ]);
// }


}
