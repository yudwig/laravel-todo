<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testShowCreate()
    {
        $this->get(route("categories.showCreate"))
            ->assertViewIs("categories.create");
    }

    public function testShowEdit()
    {
        $this->get(route("categories.showEdit", ["id" => 1]))
            ->assertViewIs("categories.edit")
            ->assertViewHas("category");
    }

    public function testCreate()
    {
        $input = [
            "title" => "TestCreate"
        ];
        $this->post(route("categories.create"), [
                "title" => $input["title"]
            ])
            ->assertRedirect(route("tasks.showIndex"));
        $latest = Category::orderBy("id", "DESC")->first();
        $this->assertEquals($input["title"], $latest["title"]);

        $this->post(route('categories.create'), [
                'title' => ''
            ])
            ->assertSessionHasErrors('title');
    }

    public function testUpdate()
    {
        $categoryId = 1;
        $input = [
            "title" => "TestUpdate"
        ];
        $this->post(route("categories.update", ["id" => $categoryId]), [
                "title" => $input["title"]
            ])
            ->assertRedirect(route("tasks.showIndex"));
        $after = Category::where("id", $categoryId)->first();
        $this->assertEquals($input["title"], $after["title"]);

        $this->post(route('categories.update', ['id' => 1]), [
                'title' => ''
            ])
            ->assertSessionHasErrors('title');
    }

    public function testDelete()
    {
        $categoryId = 1;
        $category = Category::where("id", $categoryId)->first();
        $this->post(route("categories.delete", ["id" => $categoryId]))
            ->assertRedirect(route("tasks.showIndex"));
        $this->assertDeleted($category);
    }
}
