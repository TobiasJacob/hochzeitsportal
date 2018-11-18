<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Vendor;
use Validator;

class AdminCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('adminCategories', ['categories' => Category::all()]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
    
        $category = new Category;
        $category->name = $request->name;
        $category->save();
    
        return redirect('/admin/categories');
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();

        Vendor::where('category_id', $id)->update(['category_id' => NULL]);

        return redirect('/admin/categories');
    }

    public function edit($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return redirect('/admin/categories');
    }
}
