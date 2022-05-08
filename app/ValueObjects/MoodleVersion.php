<?php

declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

class MoodleVersion
{
    public function __construct(
        public readonly string $key,
        public readonly string $title,
        public readonly string $link,
        public readonly bool $isSupporting,
    ) {}

    public static function fromKey(string $key): self
    {
        $moodleVersion = config('instances.available_moodle_versions')[$key] ?? null;

        if (!$moodleVersion) {
            throw new InvalidArgumentException('Invalid moodle version');
        }

        return new self(
            $moodleVersion['key'],
            $moodleVersion['title'],
            $moodleVersion['link'],
            $moodleVersion['is_supporting']
        );
    }
}
