<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        //$catecories = Category::get();
        $catecories = CategoryResource::collection(Category::get());
        return $this->apiResponse($catecories, 'OK', 200);
    }

    public function show($id)
    {
        $category = Category::find($id);
        //$catecory = new CategoryResource(Category::find($id));
        if ($category) {
            return $this->apiResponse(new CategoryResource($category), 'OK', 200);
        }
        return $this->apiResponse(null, 'The category not Found', 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories|max:255',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        Str::slug($request->name);
        $request->merge([
            'slug' => Str::slug($request->name),

        ]);
        $category = Category::create($request->all());

        if ($category) {
            return $this->apiResponse(new CategoryResource($category), 'The Category Save in DB', 201);
        }
        return $this->apiResponse(null, 'The category not Save', 400);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories|max:255',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $category = Category::find($id);
        if (!$category) {
            return $this->apiResponse(null, 'The category not Found', 404);
        }
        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
        ]);
        if ($category) {
            return $this->apiResponse(new CategoryResource($category), 'The Category Updated', 201);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->apiResponse(null, 'The category not Found', 404);
        }
        $category->delete($id);
        //Category::destroy($id);
        if ($category) {
            return $this->apiResponse(null, 'The Category Deleted', 200);
        }
    }
}
