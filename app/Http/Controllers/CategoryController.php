<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(Request $request) {
        $name = $request->get('name');
        Category::create(compact('name'));
        return redirect()->route('admin.categories.index');
    }

    public function delete(Category $category) {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
