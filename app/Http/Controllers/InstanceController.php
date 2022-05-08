<?php

namespace App\Http\Controllers;

use App\Http\Requests\Instance\Save;
use App\Models\Instance;
use App\Policies\InstancePolicy;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class InstanceController extends Controller
{
    // todo enum for moodle version and server provider. value objects for values
    // todo error page
    // todo nav link activity
    // todo tests (add to existing authorizations checks + index page tests)
    public function index(): Response
    {
        $availableMoodleVersions = collect(config('instances.available_moodle_versions'))->keyBy('key');
        $availableServerProviders = collect(config('instances.available_server_providers'))->keyBy('key');

        $items = Instance::query()->where('user_id', auth()->id())->orderByDesc('id')->paginate();
        $items->getCollection()->transform(function (Instance $item) use ($availableMoodleVersions, $availableServerProviders) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'moodle_version' => $availableMoodleVersions[$item->moodle_version]['title'],
                'server_provider' => $availableServerProviders[$item->server_provider]['title'],
            ];
        });

        return Inertia::render('Instance/Index', ['items' => $items]);
    }

    public function create(): Response
    {
        return Inertia::render('Instance/Form', [
            'availableMoodleVersions' => config('instances.available_moodle_versions'),
            'availableServerProviders' => config('instances.available_server_providers'),
        ]);
    }

    public function store(Save $request): RedirectResponse
    {
        Instance::query()->create(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );

        return redirect()->route('instances.index');
    }

    public function edit(Instance $instance): Response
    {
        $this->authorize(InstancePolicy::UPDATE, $instance);

        return Inertia::render('Instance/Form', [
            'availableMoodleVersions' => config('instances.available_moodle_versions'),
            'availableServerProviders' => config('instances.available_server_providers'),
            'instance' => $instance,
        ]);
    }

    public function update(Save $request, Instance $instance): RedirectResponse
    {
        $this->authorize(InstancePolicy::UPDATE, $instance);

        $instance->update($request->validated());

        return redirect()->route('instances.index');
    }

    public function destroy(Instance $instance): RedirectResponse
    {
        $this->authorize(InstancePolicy::DELETE, $instance);

        $instance->delete();

        return redirect()->route('instances.index');
    }
}
