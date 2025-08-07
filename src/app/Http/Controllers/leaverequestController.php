<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\agency;
use App\Models\employ;
use App\Models\history;
use App\Models\Leavebalance;
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
        $leavebalance = Leavebalance::get();



        return view('leaverequest.index2', compact('employs', 'agen', 'leaverequest','leavebalance'));
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
        $leavevaca = Leavebalance::get();
        return view('leaverequest.create', compact('employs', 'leavetype','leavevaca'));
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
        
        // $leaverequest = leaverequest::findOrFail($id);
        $leaverequest = Leaverequest::with(['employ.leavebalance'])->findOrFail($id);
        
        // $startdate = Carbon::parse('2024-04-23')->thaidate('วันที่ j เดือน F พ.ศ. y');
        $employs = employ::where('id',$leaverequest->employ_id)->get();
        $leavebalance = Leavebalance::where('employ_id',$leaverequest->employ_id)->get();
        $pdf = Pdf::loadView('leaverequest.pdf', compact('leaverequest', 'employs','leavebalance'));
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
        $fiscalYear = $start_date->month >= 10 ? $start_date->year + 1 : $start_date->year;

        $balance = [];

foreach ($employs as $employ) {
    $balance[$employ->id] = $employ->leavebalance()
        ->where('year', $fiscalYear)
        ->first();
}

        $pdf = Pdf::loadView('leaverequest.report', compact('leaverequest', 'employs', 'start_date', 'end_date','balance','fiscalYear'));
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
        $fiscalYear = $start_date->month >= 10 ? $start_date->year + 1 : $start_date->year;

        $balance = $employs->leavebalance()->where('year', $fiscalYear)->first();

        $pdf = Pdf::loadView('leaverequest.perreport', compact('leaverequest', 'employs','start_date','end_date','balance','fiscalYear'));
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
    $employee = employ::with('status', 'agency','leavebalance')->find($id);

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
        // 'sick_max' => $employee->sick_max,
        // 'bus_max' => $employee->bus_max,
        // 'vaca_max' => $employee->vaca_max,
        // 'total_vaca' => $totalVaca,
        // 'total_bus' => $totalBus,
        // 'total_sick' => $totalSick,
    ]);
}
public function getLeaveDetails(Request $request, $id)
{
     $employee = employ::with('leavebalance')->findOrFail($id);

    // กำหนดช่วงวันที่จาก request
    $start_date = Carbon::create($request->start_date)->startOfDay();
    $end_date = Carbon::create($request->end_date)->endOfDay();

    // คำนวณปีงบประมาณจากวันที่เริ่ม (fiscal year: 1 ต.ค. ของปีก่อน ถึง 30 ก.ย. ของปี)
    $fiscalYear = $start_date->month >= 10 ? $start_date->year + 1 : $start_date->year;
    $fiscalStart = Carbon::create($fiscalYear - 1, 10, 1)->startOfDay();
    $fiscalEnd = Carbon::create($fiscalYear, 9, 30)->endOfDay();

    // ใช้ใบลาพักผ่อนจริงภายในปีงบประมาณ (type 1)
    $usedVaca = leaverequest::where('employ_id', $id)
        ->where('leave_type_id', 1)
        ->whereBetween('start_date', [$fiscalStart, $fiscalEnd])
        ->sum('total_leave');

    // ดึง leave balance ของปีงบประมาณนั้น
    $balance = $employee->leavebalance()->where('year', $fiscalYear)->first();

    // คำนวณสิทธิ์วันลาพักผ่อนรวม (สะสม + ประจำปี)
    if ($balance && $balance->is_eligible == 1) {
        $totalVacaAvailable = ($balance->vacation_carried ?? 0) + ($balance->vacation_leave ?? 0);
        $remainVaca = max(0, $totalVacaAvailable - $usedVaca);
    } else {
        // ถ้าไม่มี leave balance หรือไม่มีสิทธิ์ fallback เป็นค่าจาก employ (vaca_max) หักที่ใช้
        $VACAMAX = $employee->vaca_max;
        $remainVaca = max(0, $VACAMAX - $usedVaca);
        $totalVacaAvailable = $VACAMAX;
    }

    // ลากิจ / ลาป่วย ยังคงคำนวณจากใบลาโดยตรง
    $totalBus = leaverequest::where('employ_id', $id)
        ->whereBetween('start_date', [$start_date, $end_date])
        ->where('leave_type_id', 2)
        ->sum('total_leave');

    $totalSick = leaverequest::where('employ_id', $id)
        ->whereBetween('start_date', [$start_date, $end_date])
        ->where('leave_type_id', 4)
        ->sum('total_leave');

    $BUSMAX = $employee->bus_max;
    $SickMAX = $employee->sick_max;

    $remainBus = max(0, $BUSMAX - $totalBus);
    $remainSick = max(0, $SickMAX - $totalSick);

    return response()->json([
        'total_vaca_used' => $usedVaca,
        'total_vaca_available' => $totalVacaAvailable,
        'remain_vaca' => $remainVaca,
        'total_bus' => $totalBus,
        'remain_bus' => $remainBus,
        'total_sick' => $totalSick,
        'remain_sick' => $remainSick,
        'sick_max' => $employee->sick_max,
        'bus_max' => $employee->bus_max,
        'vaca_max_fallback' => $employee->vaca_max, // กรณี fallback
        'fiscal_year' => $fiscalYear,
        'fiscal_start' => $fiscalStart->toDateString(),
        'fiscal_end' => $fiscalEnd->toDateString(),
    ]);
//     $employee = employ::with('leavebalance')->find($id);

    
//         $start_date = Carbon::create($request->start_date)->startOfDay();
//         $end_date = Carbon::create($request->end_date)->endOfDay();
    
//     $totalVaca = leaverequest::where('employ_id', $id)
//         ->whereBetween('start_date', [$start_date, $end_date])
//         ->where('leave_type_id', 1)
//         ->sum('total_leave');

//     $totalBus = leaverequest::where('employ_id', $id)
//         ->whereBetween('start_date', [$start_date, $end_date])
//         ->where('leave_type_id', 2)
//         ->sum('total_leave');

//     $totalSick = leaverequest::where('employ_id', $id)
//         ->whereBetween('start_date', [$start_date, $end_date])
//         ->where('leave_type_id', 4)
//         ->sum('total_leave');
//    $VACAMAX = employ::where('id', $id)->value('vaca_max');
//    $BUSMAX = employ::where('id', $id)->value('bus_max');  
//    $SickMAX = employ::where('id', $id)->value('sick_max');

//    $remainVaca = $VACAMAX - $totalVaca;
//    $remainBus = $BUSMAX - $totalBus;
//     $remainSick = $SickMAX - $totalSick; 
//     return response()->json([
//         'total_vaca' => $totalVaca,
//         'total_bus' => $totalBus,
//         'total_sick' => $totalSick,
//         'start_date' => $start_date,
//         'end_date' => $end_date,
//         'remain_vaca' => $remainVaca,
//         'remain_bus' => $remainBus,
//         'remain_sick' => $remainSick,
//         'sick_max' => $employee->sick_max,
//         'bus_max' => $employee->bus_max,
//         'vaca_max' => $employee->vaca_max,
        
//     ]);
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
