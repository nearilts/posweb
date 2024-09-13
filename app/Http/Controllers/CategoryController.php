<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $data['data'] = Category::latest()->get();
        return view('category.index', $data);
    }
    
    public function store(Request $request) {
        $save = Category::create($request->all());

        return redirect()->back()->with('success', 'Your data has been saved successfully!');
    }

    
    public function update(Request $request, $id) {
        $save = Category::find($id)->update($request->all());

        return redirect()->back()->with('success', 'Your data has been updated successfully!');
    }
    
    public function destroy( $id) {
        $save = Category::find($id)->delete();

        return redirect()->back()->with('success', 'Your data has been delete successfully!');
    }
}
