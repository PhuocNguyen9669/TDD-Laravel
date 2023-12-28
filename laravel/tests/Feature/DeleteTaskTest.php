<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_delete_task_if_task_exists()
    {
        $this->actingAs(User::factory()->create());

        // $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', 192));

        $response->assertFound();
    }

    /** @test */
    public function authenticated_user_can_not_delete_task_if_task_is_not_exists()
    {
        $taskId = -1;

        $this->actingAs(User::factory()->create());

        $response = $this->delete(route('tasks.destroy', $taskId));

        $response->assertNotFound();
    }

       /** @test */
       public function unauthenticated_user_can_not_delete_task()
       {
           $response = $this->delete(route('tasks.destroy', 1));

           $response->assertRedirect('/login');;
       }
}
