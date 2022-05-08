<?php

return [
    'available_moodle_versions' => [
        '400' => [
            'key' => '400',
            'title' => 'Moodle 4.0',
            'link' => 'https://download.moodle.org/download.php/stable400/moodle-latest-400.tgz',
            'is_supporting' => true,
        ],
        '311' => [
            'key' => '311',
            'title' => 'Moodle 3.11',
            'link' => 'https://download.moodle.org/download.php/stable311/moodle-latest-311.tgz',
            'is_supporting' => true,
        ]
    ],
    'available_server_providers' => [
        [
            'key' => 'vultr',
            'title' => 'Vultr',
        ],
    ],
];
