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
        $leaverequest = leaverequest::latest();
        return view('leaverequest.index', compact('leaverequest'));
    }
    public function index2(Request $request)
    {
        
        $employs = employ::get();
        $agen = agency::get();
        $leaverequest = leaverequest::get();
        
        
    
        return view('leaverequest.index2',compact('employs','agen','leaverequest'));
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
        return view('leaverequest.create', compact('employs','leavetype'));
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
        return view('leaverequest.edit', compact('leaverequest', 'employs','leavetype'));
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
        $pdf = Pdf::loadView('leaverequest.pdf', compact('leaverequest','employs'));
        return $pdf->stream("leaverequest-{$id}.pdf");
    }
   
    

}
