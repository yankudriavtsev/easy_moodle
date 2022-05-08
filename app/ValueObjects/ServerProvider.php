<?php

declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

class ServerProvider
{
    public function __construct(
        public readonly string $key,
        public readonly string $title,
    ) {}

    public static function fromKey(string $key): self
    {
        $serverProvider = config('instances.available_server_providers')[$key] ?? null;

        if (!$serverProvider) {
            throw new InvalidArgumentException('Invalid server provider');
        }

        return new self(
            $serverProvider['key'],
            $serverProvider['title'],
        );
    }
}
