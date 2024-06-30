<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    public function __construct()
    {
        if (auth()->check() && !auth()->user()->hasRole('super-admin')) {
            $this->middleware('permission:school-edit')->only(['edit', 'update']);
            $this->middleware('permission:school-create')->only(['create', 'store']);
            $this->middleware('permission:school-delete')->only('destroy');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = School::all();
        $result = [
            'data' => $data,
            'title' => __('admin.Schools'),
            'addUrl' => [
                'url' => route('schools.create'),
                'text' => __('admin.Add')
            ]
        ];
        return view('pages.schools.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $result = [
            'title' => __('admin.Add New') . ' ' . __('admin.School'),
        ];
        return view('pages.schools.edit', $result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', __('admin.Failed to create item'))->withErrors($validator)->withInput();
        }

        $school = School::create($request->only(['name']));
        if ($school) {
            return redirect()->route('schools.index')->with('success', __('admin.Item created successfully'));
        }
        return redirect()->back()->with('error', __('admin.Failed to create item'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $this->edit($id, $request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $data = School::findOrFail($id);
        $result = [
            'selectedItem' => $data,
            'title' => __('admin.Edit') . ' ' . __('admin.School'),
        ];
        return view('pages.schools.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', __('admin.Failed to update item'))->withErrors($validator)->withInput();
        }

        $school = School::findOrFail($id);
        if ($school) {
            $school->update($request->only(['name']));
            return redirect()->route('schools.index')->with('success', __('admin.Item updated successfully'));
        }
        return redirect()->back()->with('error', __('admin.Failed to update item'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $school = School::findOrFail($id);
        if ($school) {
            $school->delete();
        }
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('admin.Item deleted successfully')
            ]);
        }
        return redirect()->route('schools.index')->with('success', __('admin.Item deleted successfully'));
    }
}
