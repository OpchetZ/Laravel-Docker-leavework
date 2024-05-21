<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\agency;
use App\Models\employ;
use App\Models\position;
use App\Models\status;
use Illuminate\Http\Request;

class employController extends Controller
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
            $employ = employ::where('name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('Acc_vaca_day', 'LIKE', "%$keyword%")
                ->orWhere('status_id', 'LIKE', "%$keyword%")
                ->orWhere('post_id', 'LIKE', "%$keyword%")
                ->orWhere('agent_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $employ = employ::latest()->paginate($perPage);
        }

        return view('employ.index', compact('employ'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $statuses = status::get();
        $positions = position::get();
        $agencies = agency::get();

        return view('employ.create',compact('statuses','positions','agencies'));
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
        
        employ::create($requestData);

        return redirect('employ')->with('flash_message', 'employ added!');
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
        $employ = employ::findOrFail($id);

        return view('employ.show', compact('employ'));
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
        $employ = employ::findOrFail($id);
        $statuses = status::get();
        $positions = position::get();
        $agencies = agency::get();

        return view('employ.edit', compact('employ','statuses','positions','agencies'));
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
        
        $employ = employ::findOrFail($id);
        $employ->update($requestData);

        return redirect('employ')->with('flash_message', 'employ updated!');
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
        employ::destroy($id);

        return redirect('employ')->with('flash_message', 'employ deleted!');
    }
}
