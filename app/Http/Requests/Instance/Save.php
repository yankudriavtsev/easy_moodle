<?php

namespace App\Http\Requests\Instance;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $name
 * @property-read string $moodle_version
 * @property-read string $server_provider
 */
class Save extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'moodle_version' => [
                'required',
                'string',
                'in:' . implode(',', array_column(config('instances.available_moodle_versions'), 'key')),
            ],
            'server_provider' => [
                'required',
                'string',
                'in:' . implode(',', array_column(config('instances.available_server_providers'), 'key')),
            ],
        ];
    }
}
