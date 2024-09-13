<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $data['data'] = Product::latest()->get();
        return view('product.index', $data);
    }

    public function create() {
        $data['category'] = Category::latest()->get();
        return view('product.create', $data);
    }
    
    public function store(Request $request) {

        $datas = $request->all();

        $category = Category::find($request->cateogry_id);
        if (!$category) {
            return redirect()->back()->withInput()->with('error', 'Category tidak ada!');
        }
        $datas['category'] = $category->name;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $path = $file->move('public/file_upload', $imageName, 'public');
            $datas['foto'] = 'public/file_upload/'.$imageName;
        }
        $save = Product::create($datas);

        return redirect()->back()->with('success', 'Your data has been saved successfully!');
    }

    
    public function update(Request $request, $id) {
        $save = Product::find($id);
        $datas = $request->all();

        $category = Category::find($request->cateogry_id);
        if (!$category) {
            return redirect()->back()->withInput()->with('error', 'Category tidak ada!');
        }
        $datas['category'] = $category->name;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $path = $file->move('public/file_upload', $imageName, 'public');
            $datas['foto'] = 'public/file_upload/'.$imageName;
        }


        $save->update($datas);
        return redirect()->back()->with('success', 'Your data has been updated successfully!');
    }

    public function edit(Product $product) {
        $data['category'] = Category::latest()->get();
        $data['data'] = $product;
        return view('product.edit', $data);
    }
    
    public function destroy( $id) {
        $save = Product::find($id)->delete();

        return redirect()->back()->with('success', 'Your data has been delete successfully!');
    }
}
