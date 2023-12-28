<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    public function getUpdateTaskRoute($id)
    {
        return route('tasks.update', $id);
    }

    public function getUpdateTaskViewRoute($id)
    {
        return route('tasks.edit', $id);
    }

    /** @test */
    public function authenticated_user_can_update_task()
    {
        $this->actingAs(User::factory()->create());

        // $task = Task::factory()->create();
        $task = [
            'name' => 'aba',
            'content' => 'aba'
        ];

        $response = $this->put($this->getUpdateTaskRoute(190), $task);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('tasks', $task);

        $response->assertRedirect(route('tasks.index'));
    }

    /** @test */
    public function unauthenticated_user_can_not_update()
    {
        // $task = Task::factory()->create();
        $task = [
            'name' => 'ggggggg',
            'content' => 'hhhhhh'
        ];

        $reponse = $this->put($this->getUpdateTaskRoute(190), $task);

        $reponse->assertStatus(Response::HTTP_FOUND);

        $reponse->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_not_update_task_if_name_is_null()
    {
        $this->actingAs(User::factory()->create());

        $dataUpdate = [
            'name' => null,
            'content' => $this->faker->text
        ];

        $response = $this->put($this->getUpdateTaskRoute(10), $dataUpdate);

        $response->assertSessionHasErrors(['name']);
    }

     /** @test */
    public function authenticated_user_can_see_name_update_text_required_if_validate_error()
    {
        $this->actingAs(User::factory()->create());

        $dataUpdate = [
            'name' => null,
            'content' => $this->faker->text
        ];

        $response = $this->put($this->getUpdateTaskRoute(183), $dataUpdate);

        $response->assertSessionHasErrors(['name']);
    }

   /** @test */
    public function unauthenticated_user_can_not_see_update_task_form_view()
    {
        $response = $this->get($this->getUpdateTaskViewRoute(1));

        $response->assertRedirect('/login');
    }

}
