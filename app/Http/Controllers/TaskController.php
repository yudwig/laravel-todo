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
        Task::create([
            "title" => $request->input("title"),
            "completed" => $request->input("completed"),
            "category_id" => $categoryId
        ]);
        return redirect(route("tasks.showIndex"));
    }

    public function update(Request $request, $taskId)
    {
        $task = Task::where("id", $taskId)->first();
        if (isset($request["title"])) {
            $task->title = $request["title"];
        }
        if (isset($request["completed"])) {
            $task->completed = $request["completed"];
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
