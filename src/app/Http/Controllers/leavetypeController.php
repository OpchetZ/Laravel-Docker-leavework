<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\leavetype;
use Illuminate\Http\Request;

class leavetypeController extends Controller
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
            $leavetype = leavetype::where('leave_type_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $leavetype = leavetype::latest()->paginate($perPage);
        }

        return view('leavetype.index', compact('leavetype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('leavetype.create');
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
        
        leavetype::create($requestData);

        return redirect('leavetype')->with('flash_message', 'leavetype added!');
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
        $leavetype = leavetype::findOrFail($id);

        return view('leavetype.show', compact('leavetype'));
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
        $leavetype = leavetype::findOrFail($id);

        return view('leavetype.edit', compact('leavetype'));
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
        
        $leavetype = leavetype::findOrFail($id);
        $leavetype->update($requestData);

        return redirect('leavetype')->with('flash_message', 'leavetype updated!');
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
        leavetype::destroy($id);

        return redirect('leavetype')->with('flash_message', 'leavetype deleted!');
    }
}
