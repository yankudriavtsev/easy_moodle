<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instance>
 */
class InstanceFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "string", 'user_id' => "\Database\Factories\UserFactory", 'moodle_version' => "string", 'server_provider' => "string"])]
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10),
            'user_id' => User::factory(),
            'moodle_version' => collect(config('instances.available_moodle_versions'))->keys()->first(),
            'server_provider' => collect(config('instances.available_server_providers'))->keys()->first(),
        ];
    }
}
