<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testShowIndex()
    {
        $this->get(route('tasks.showIndex'))
            ->assertViewIs('tasks.index')
            ->assertViewHas('categories');
    }

    public function testShowCreate()
    {
        $this->seed();
        $this->get(route('tasks.showCreate', ['id' => 1]))
            ->assertViewIs('tasks.create');
    }

    public function testShowEdit()
    {
        $this->seed();
        $this->get(route('tasks.showEdit', ['id' => 1]))
            ->assertViewIs('tasks.edit')
            ->assertViewHas('task');
    }

    public function testCreate()
    {
        $this->seed();
        $truth = [
            'title' => 'TestCreate',
            'completed' => 1
        ];
        $this->post(route('tasks.create', ['id' => 1]), [
            'title' => $truth['title'],
            'completed' => $truth['completed']
        ])
            ->assertRedirect(route('tasks.showIndex'));
        $latest = Task::orderBy('id', 'DESC')->first();
        $this->assertEquals($truth['title'], $latest['title']);
        $this->assertEquals($truth['completed'], $latest['completed']);
    }

    public function testUpdate()
    {
        $this->seed();
        $id = 1;
        $truth = [
            'title' => 'TestUpdate',
            'completed' => 1
        ];
        $before = Task::where('id', $id)->first();
        $this->from(route('tasks.showEdit', ['id' => $id]))
            ->post(route('tasks.update', ['id' => $id]), [
                'title' => $truth['title'],
                'completed' => $truth['completed']
            ])
            ->assertRedirect(route('tasks.showIndex'));
        $after = $before->fresh();
        $this->assertEquals($truth['title'], $after->title);
        $this->assertEquals($truth['completed'], $after->completed);
    }

    public function testDelete()
    {
        $this->seed();
        $id = 1;
        $task = Task::where('id', $id)->first();
        $this->post(route('tasks.delete', ['id' => $id]))
            ->assertRedirect(route('tasks.showIndex'));
        $this->assertDeleted($task);
    }
}
