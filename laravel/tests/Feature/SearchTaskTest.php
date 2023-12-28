<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTaskTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_search_if_name_exists()
    {
        $task = Task::factory()->create([
            'name' => 'task',
            'content' => ''
        ]);
        $response = $this->get('/tasks?search?=', $task->toArray());

        $response->assertStatus(200);

        $response->assertSee($task['name']);

    }

    /** @test */
    public function authenticated_user_can_search_if_content_exists()
    {
        $task = Task::factory()->create([
            'name' => '',
            'content' => 'content'
        ]);
        $response = $this->get('/tasks?search?=', $task->toArray());

        $response->assertStatus(200);

        $response->assertSee($task['content']);
    }

    /** @test */
    public function authenticated_user_can_not_search_if_task_not_exists()
    {
        $task = [
            'name' => $this->faker->name,
            'content' => $this->faker->text
        ];

        $response = $this->get('/tasks?search=', $task);

        $response->assertDontSee($task['name']);

        $response->assertDontSee($task['content']);
    }

}
