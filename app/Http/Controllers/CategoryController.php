<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', [
            'title' => 'Categories List',
            'category' => $categories,
        ]);
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories|max:255',
        ]);
        Str::slug($request->name);
        $request->merge([
            'slug' => Str::slug($request->name),

        ]);
        $category = Category::create($request->all());
        return redirect('/dashboard/categories')->with('success', 'Category Added!!!');
    }


    public function show(Category $category)
    {
        $lots = $category->lots()->paginate(9);
        return view('category.lots', compact('category', 'lots'));
    }

    public function edit($id)
    {

        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:categories|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),

        ]);
        return redirect('/dashboard/categories')->with('success', 'Category updated!!!');
    }
    public function destroy($id)
    {

        Category::destroy($id);
        return redirect('/dashboard/categories')->with('success', 'Category Deleted!!!');
    }
}
