<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase; // Use this trait to refresh the database for each test

    /**
     * Test that the tasks index page can be rendered.
     */
    public function test_tasks_index_page_can_be_rendered(): void
    {
        $task = Task::factory()->create(); // Create a task using a factory

        $response = $this->get('/tasks');

        $response->assertStatus(200);
        $response->assertSee($task->name);
        $response->assertViewHas('tasks');
    }

    /**
     * Test that a task can be created.
     */
    public function test_task_can_be_created(): void
    {
        $this->post('/tasks', [
            'name' => 'New Task',
            'description' => 'This is a description for the new task.',
        ])
        ->assertRedirect('/tasks')
        ->assertSessionHas('success', 'Task created successfully.');

        $this->assertDatabaseHas('tasks', [
            'name' => 'New Task',
            'description' => 'This is a description for the new task.',
        ]);
    }

    /**
     * Test that a task cannot be created with invalid data.
     */
    public function test_task_cannot_be_created_with_invalid_data(): void
    {
        $response = $this->post('/tasks', [
            'name' => '', // Invalid data: missing name
            'description' => 'This is a description.',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseMissing('tasks', [
            'description' => 'This is a description.',
        ]);
    }

    /**
     * Test that a task can be updated.
     */
    public function test_task_can_be_updated(): void
    {
        $task = Task::factory()->create();

        $this->put('/tasks/' . $task->id, [
            'name' => 'Updated Task Name',
            'description' => 'Updated description.',
        ])
        ->assertRedirect('/tasks')
        ->assertSessionHas('success', 'Task updated successfully.');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Updated Task Name',
            'description' => 'Updated description.',
        ]);
    }

    /**
     * Test that a task cannot be updated with invalid data.
     */
    public function test_task_cannot_be_updated_with_invalid_data(): void
    {
        $task = Task::factory()->create();

        $response = $this->put('/tasks/' . $task->id, [
            'name' => '', // Invalid data: missing name
            'description' => 'Updated description.',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $task->name, // Name should not have changed
        ]);
    }

    /**
     * Test that a task can be deleted.
     */
    public function test_task_can_be_deleted(): void
    {
        $task = Task::factory()->create();

        $this->delete('/tasks/' . $task->id)
            ->assertRedirect('/tasks')
            ->assertSessionHas('success', 'Task deleted successfully.');

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
