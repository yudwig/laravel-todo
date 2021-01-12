<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function showCreateView()
    {
        return view("categories.create");
    }

    public function showEditView($categoryId)
    {
        return view("categories.edit", [
            "category" => Category::where("id", $categoryId)->first()
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => ['required']
        ]);
        Category::create([
            "title" => $request->input("title")
        ]);
        return redirect(route("tasks.showIndex"));
    }

    public function update(Request $request, $categoryId)
    {
        $request->validate([
            'title' => ['required']
        ]);
        $category = Category::where("id", $categoryId)->first();
        $category->fill([
            "title" => $request->input("title")
        ]);
        $category->save();
        return redirect(route("tasks.showIndex"));
    }

    public function delete($categoryId)
    {
        $category = Category::where("id", $categoryId)->first();
        $category->delete();
        return redirect(route("tasks.showIndex"));
    }
}
