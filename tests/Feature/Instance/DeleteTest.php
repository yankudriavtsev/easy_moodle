<?php

declare(strict_types=1);

namespace Tests\Feature\Instance;

use App\Models\Instance;
use App\Models\User;
use App\ValueObjects\MoodleVersion;
use App\ValueObjects\ServerProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_delete_instance(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Instance $instance */
        $instance = Instance::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('instances.destroy', ['instance' => $instance->id]));

        $response->assertRedirect(route('instances.index'));
        $this->assertDatabaseMissing(Instance::class, [
            'name' => $instance->name,
            'user_id' => $user->id,
            'moodle_version' => $instance->moodle_version,
            'server_provider' => $instance->server_provider,
        ]);
    }
}
