<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_task(): void
    {
        $response = $this->post(route('tasks.store'), [
            'task_name' => 'Design UI mockup',
            'description' => 'Create the dashboard layout and cards.',
            'status' => 'Pending',
            'due_date' => '2026-10-15',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Design UI mockup',
            'description' => 'Create the dashboard layout and cards.',
            'status' => 'Pending',
        ]);
    }

    public function test_user_can_update_a_task_status(): void
    {
        $task = Task::create([
            'task_name' => 'Prepare presentation',
            'description' => 'Summarize weekly progress.',
            'status' => 'Pending',
            'due_date' => '2026-10-20',
        ]);

        $response = $this->put(route('tasks.update', $task), [
            'task_name' => 'Prepare presentation',
            'description' => 'Summarize weekly progress.',
            'status' => 'Completed',
            'due_date' => '2026-10-20',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'Completed',
        ]);
    }
}
