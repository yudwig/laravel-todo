<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;

class TaskController extends Controller
{
    public function showIndexView()
    {
        return view("tasks.index", [
            "categories" => Category::with("task")->get()
        ]);
    }

    public function showCreateView()
    {
        return view("tasks.create");
    }

    public function showEditView($taskId)
    {
        return view("tasks.edit", [
            "task" => Task::where("id", $taskId)->first()
        ]);
    }

    public function create(Request $request, $categoryId)
    {
        $request->validate([
            'title' => ['required']
        ]);
        Task::create([
            "title" => $request->input("title"),
            "category_id" => $categoryId
        ]);
        return redirect(route("tasks.showIndex"));
    }

    public function update(Request $request, $taskId)
    {
        $request->validate([
            'title' => ['sometimes', 'required']
        ]);
        $task = Task::where("id", $taskId)->first();
        if ($request->has("title")) {
            $task->title = $request->input("title");
        }
        if ($request->has("completed")) {
            $task->completed = $request->input("completed");
        }
        $task->save();
        return redirect(route("tasks.showIndex"));
    }

    public function delete($taskId)
    {
        $task = Task::where("id", $taskId)->first();
        $task->delete();
        return redirect(route("tasks.showIndex"));
    }
}
