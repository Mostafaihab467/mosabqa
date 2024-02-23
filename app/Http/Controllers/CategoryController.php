<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        $result = [
            'data' => $data,
            'title' => __('admin.Categories'),
            'addUrl' => [
                'url' => route('categories.create'),
                'text' => __('admin.Add')
            ]
        ];
        return view('pages.categories.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $result = ['title' => __('admin.Add New') . ' ' . __('Category')];
        return view('pages.categories.edit', $result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', __('admin.Failed to create item'))->withErrors($validator)->withInput();
        }

        // create a new category
        $category = Category::create([
            'name' => $request->name,
            'record_state' => $request->record_state ?? '0',
        ]);
        if ($category) {
            return redirect()->route('categories.index')->with('success', __('admin.Item created successfully'));
        }
        return redirect()->back()->with('error', __('admin.Failed to create item'))->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        return $this->edit($id, $request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $data = Category::find($id);
        $result = [
            'selectedItem' => $data,
            'title' => __('admin.Edit') . ' ' . $data->name,
        ];
        return view('pages.categories.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', __('admin.Failed to update item'))->withErrors($validator)->withInput();
        }

//        return $request->all();
        // update the category
        $category = Category::find($id)->update([
            'name' => $request->name,
            'record_state' => $request->record_state ?? '0',
        ]);
        if ($category) {
            return redirect()->route('categories.index')->with('success', __('admin.Item updated successfully'));
        }
        return redirect()->back()->with('error', __('admin.Failed to update item'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
