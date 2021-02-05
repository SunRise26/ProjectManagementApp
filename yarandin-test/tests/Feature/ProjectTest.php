<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function testCreateProjectUnauthenticated()
    {
        $data = [
            'title' => 'Test Project',
            'description' => "Test Desc",
            'position' => 3,
        ];

        $response = $this->postJson('/api/projects', $data);
        $response->assertStatus(401);
    }

    public function testCreateProject()
    {
        $user = User::factory()->create();

        $data = [
            'title' => 'Test Project',
            'description' => "Test Desc",
            'position' => 3,
        ];
        $response = $this->actingAs($user, 'api')->postJson('/api/projects', $data);
        $response->assertStatus(201);
    }

    public function testCreateProjectInvalidData()
    {
        $user = User::factory()->create();

        $data = [
            'title' => '',
            'description' => "Test Desc",
            'position' => 3,
        ];
        $response = $this->actingAs($user, 'api')->postJson('/api/projects', $data);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'title' => ['The title field is required.'],
            ]
        ]);
    }

    public function testUpdateProjectUnauthenticated()
    {
        $project = Project::factory()->create();

        $data = [
            'position' => 3,
        ];

        $response = $this->patchJson("/api/projects/$project->id", $data);
        $response->assertStatus(401);
    }

    public function testUpdateProjectUnauthorized()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $data = [
            'position' => 100,
        ];
        $response = $this->actingAs($user, 'api')->patchJson("/api/projects/$project->id", $data);
        $response->assertStatus(404);
    }

    public function testUpdateProject()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['creator_id' => $user]);

        $data = [
            'position' => 100,
        ];
        $response = $this->actingAs($user, 'api')->patchJson("/api/projects/$project->id", $data);
        $response->assertStatus(200);
    }

    public function testUpdateProjectInvalidData()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['creator_id' => $user]);

        $data = [
            'description' => "Test Desc",
            'position' => 100000,
        ];
        $response = $this->actingAs($user, 'api')->patchJson("/api/projects/$project->id", $data);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'position' => ['The position may not be greater than 10000.'],
            ]
        ]);
    }

    public function testDeleteProjectUnauthenticated()
    {
        $project = Project::factory()->create();

        $response = $this->delete("/api/projects/$project->id");
        $response->assertStatus(302);
    }

    public function testDeleteProjectUnauthorized()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this->actingAs($user, 'api')->delete("/api/projects/$project->id");
        $response->assertStatus(404);
    }

    public function testDeleteProject()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['creator_id' => $user]);

        $response = $this->actingAs($user, 'api')->delete("/api/projects/$project->id");
        $response->assertStatus(200);
    }
}
