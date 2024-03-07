<?php

namespace App\Http\Controllers;

use App\Models\Lookup;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lookup-edit')->only('edit', 'update');
        $this->middleware('permission:lookup-create')->only('create', 'store');
    }

    public function index()
    {
        $lookups = Lookup::all();
        $result = [
            'data' => $lookups,
            'title' => __('admin.Lookups'),
        ];
        return view('pages.lookups.index', $result);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $this->edit($id);
    }


    public function edit($id)
    {
        $lookup = Lookup::find($id);
        $result = [
            'title' => __('admin.Edit') . ' ' . $lookup->name,
            'selectedItem' => $lookup,
        ];
        return view('pages.lookups.edit', $result);
    }


    public function update(Request $request, $id)
    {
        $lookup = Lookup::find($id);

        $value = $request->value;
        $recordState = $request->record_state ?? 0;
        $lookup->update([
            'value' => $value,
            'record_state' => $recordState
        ]);
        return redirect()->route('lookups.index');
    }


    public function destroy($id)
    {
        //
    }
}
