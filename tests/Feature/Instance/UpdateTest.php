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

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_edit_instance_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $instance = Instance::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('instances.edit', ['instance' => $instance->id]));
        $response->assertStatus(200);
    }

    public function test_user_can_update_instance(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Instance $instance */
        $instance = Instance::factory()->create(['user_id' => $user->id]);
        $moodleVersion = MoodleVersion::fromKey(
            collect(config('instances.available_moodle_versions'))->keys()->last()
        );
        $serverProvider = ServerProvider::fromKey(
            collect(config('instances.available_server_providers'))->keys()->last()
        );

        $response = $this->actingAs($user)->put(route('instances.update', ['instance' => $instance->id]), [
            'name' => $name = $this->faker->text(10),
            'moodle_version' => $moodleVersion = $moodleVersion->key,
            'server_provider' => $serverProvider = $serverProvider->key,
        ]);

        $response->assertRedirect(route('instances.index'));
        $this->assertDatabaseHas(Instance::class, [
            'name' => $name,
            'user_id' => $user->id,
            'moodle_version' => $moodleVersion,
            'server_provider' => $serverProvider,
        ]);
    }
}
