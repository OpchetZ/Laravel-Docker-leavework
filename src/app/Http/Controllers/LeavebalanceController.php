<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\employ;
use App\Models\Leavebalance;
use App\Models\status;
use Illuminate\Http\Request;

class LeavebalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $leavebalance = Leavebalance::where('employ_id', 'LIKE', "%$keyword%")
                ->orWhere('year', 'LIKE', "%$keyword%")
                ->orWhere('vacation_leave', 'LIKE', "%$keyword%")
                ->orWhere('vacation_carried', 'LIKE', "%$keyword%")
                ->orWhere('max_carry', 'LIKE', "%$keyword%")
                ->orWhere('is_eligible', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $leavebalance = Leavebalance::latest()->paginate($perPage);
        }

        return view('leavebalance.index', compact('leavebalance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
         $employs = employ::all(['id', 'name', 'status_id']);
         $status = status::get();
        return view('leavebalance.create', compact('employs','status'));
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
        
        Leavebalance::create($requestData);

        return redirect('leavebalance')->with('flash_message', 'Leavebalance added!');
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
        $leavebalance = Leavebalance::findOrFail($id);

        return view('leavebalance.show', compact('leavebalance'));
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
        $leavebalance = Leavebalance::findOrFail($id);
        $employs = employ::get();

        return view('leavebalance.edit', compact('leavebalance','employs'));
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
        
        $leavebalance = Leavebalance::findOrFail($id);
        $leavebalance->update($requestData);

        return redirect('leavebalance')->with('flash_message', 'Leavebalance updated!');
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
        Leavebalance::destroy($id);

        return redirect('leavebalance')->with('flash_message', 'Leavebalance deleted!');
    }
}
