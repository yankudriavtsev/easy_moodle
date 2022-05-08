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

class CreateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_instance_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('instances.create'));
        $response->assertStatus(200);
    }

    public function test_user_can_create_instance(): void
    {
        $user = User::factory()->create();
        $moodleVersion = MoodleVersion::fromKey(
            collect(config('instances.available_moodle_versions'))->keys()->first()
        );
        $serverProvider = ServerProvider::fromKey(
            collect(config('instances.available_server_providers'))->keys()->first()
        );

        $response = $this->actingAs($user)->post(route('instances.store'), [
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
