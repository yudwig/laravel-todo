<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testShowIndex()
    {
        $this->get(route("tasks.showIndex"))
            ->assertViewIs("tasks.index")
            ->assertViewHas("categories");
    }

    public function testShowCreate()
    {
        $this->get(route("tasks.showCreate", ["id" => 1]))
            ->assertViewIs("tasks.create");
    }

    public function testShowEdit()
    {
        $this->get(route("tasks.showEdit", ["id" => 1]))
            ->assertViewIs("tasks.edit")
            ->assertViewHas("task");
    }

    public function testCreate()
    {
        $categoryId = 2;
        $input = [
            "title" => "TestCreate",
        ];
        $this->post(route("tasks.create", ["id" => $categoryId]), [
                "title" => $input["title"],
            ])
            ->assertRedirect(route("tasks.showIndex"));
        $latest = Task::orderBy("id", "DESC")->first();
        $this->assertEquals($input["title"], $latest["title"]);
        $this->assertEquals($categoryId, $latest["category_id"]);
        $this->assertEquals(0, $latest["completed"]);

        $this->post(route('tasks.create', ['id' => 1]), [
                'title' => '',
            ])
            ->assertSessionHasErrors('title');
    }

    public function testUpdate()
    {
        $taskId = 1;
        $input = [
            "title" => "TestUpdate",
            "completed" => 1
        ];
        $before = Task::where("id", $taskId)->first();
        $this->from(route("tasks.showEdit", ["id" => $taskId]))
            ->post(route("tasks.update", ["id" => $taskId]), [
                "title" => $input["title"],
                "completed" => $input["completed"]
            ])
            ->assertRedirect(route("tasks.showIndex"));
        $after = $before->fresh();
        $this->assertEquals($input["title"], $after->title);
        $this->assertEquals($input["completed"], $after->completed);

        $this->from(route('tasks.showEdit', ['id' => 1]))
            ->post(route('tasks.update', ['id' => 1]), [
                'title' => '',
            ])
            ->assertSessionHasErrors('title');
    }

    public function testDelete()
    {
        $taskId = 1;
        $task = Task::where("id", $taskId)->first();
        $this->post(route("tasks.delete", ["id" => $taskId]))
            ->assertRedirect(route("tasks.showIndex"));
        $this->assertDeleted($task);
    }
}
