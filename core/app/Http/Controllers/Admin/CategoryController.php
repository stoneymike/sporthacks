<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderby('serial')->paginate(getPaginate());
        $pageTitle = 'Categories';
        $empty_message = 'No category has been added.';
        return view('admin.category.index', compact('pageTitle', 'empty_message', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
            'serial' => 'required|integer|gt:0|unique:categories,serial',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->serial = $request->serial;
        $category->save();

        $notify[] = ['success', 'Category Added'];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:categories,name,'.$category->id,
            'serial' => 'required|integer|gt:0|unique:categories,serial,'.$category->id,
        ]);

        $category->name = $request->name;
        $category->serial = $request->serial;
        $category->save();

        $notify[] = ['success', 'Category Updated'];
        return back()->withNotify($notify);
    }

    public function status(Category $category)
    {
        $category->status = ($category->status ? 0 : 1);
        $category->save();

        $notify[] = ['success', 'Category '. ($category->status ? 'Activated!' : 'Deactivated!')];
        return back()->withNotify($notify);
    }
}
