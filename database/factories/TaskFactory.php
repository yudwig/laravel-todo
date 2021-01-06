<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'completed' => $this->faker->numberBetween(0, 1),
            'category_id' => Category::all()->random()
        ];
    }
}
