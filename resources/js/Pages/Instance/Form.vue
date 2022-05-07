<template>
    <BreezeAuthenticatedLayout>
        <Head title="Create Instance" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ instance.id ? 'Update instance' : 'Create instance' }}
            </h2>
        </template>

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="mb-3">
                <app-label for="name" value="Instance Name" />
                <app-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
            </div>

            <div class="mb-3">
                <app-label for="moodleVersion" value="moodleVersion" />
                <app-select
                    id="moodleVersion"
                    class="mt-1 block w-full"
                    v-model="form.moodle_version"
                    :options="moodleVersionsOptions"
                    :value="instance.moodle_version"
                />
            </div>

            <div class="mb-4">
                <app-label for="serverAdapter" value="Server Provider" />
                <app-select
                    id="serverProvider"
                    class="mt-1 block w-full"
                    v-model="form.server_provider"
                    :options="serverProvidersOptions"
                    :value="instance.server_provider"
                />
            </div>

            <div class="flex items-center justify-start">
                <app-button
                    attr-type="submit"
                    class="mr-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ instance.id ? 'Update' : 'Create' }}
                </app-button>
                <inertia-link :href="route('instances.index')" class="btn">{{ 'Cancel' }}</inertia-link>
            </div>
        </form>
    </BreezeAuthenticatedLayout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeValidationErrors from '@/Components/ValidationErrors';
    import AppLabel from '@/Components/Label';
    import AppInput from '@/Components/Input';
    import AppButton from '@/Components/Button';
    import AppSelect from '@/Components/Select';
    import {Head} from '@inertiajs/inertia-vue3';
    import {InertiaLink} from '@inertiajs/inertia-vue3';

    export default {
        props: {
            availableMoodleVersions: {
                type: Array,
                required: true,
            },
            availableServerProviders: {
                type: Array,
                required: true,
            },
            instance: {
                type: Object,
                default: () => ({})
            }
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.instance.name || '',
                    moodle_version: this.instance.moodle_version || this.availableMoodleVersions[0].key,
                    server_provider: this.instance.server_provider || this.availableServerProviders[0].key,
                }),
            };
        },
        methods: {
            submit() {
                if (this.instance.id) {
                    this.form.put(route('instances.update', {instance: this.instance.id}));
                } else {
                    this.form.post(route('instances.store'));
                }
            }
        },
        computed: {
            moodleVersionsOptions() {
                return this.availableMoodleVersions.map(item => {
                    return {value: item.key, title: item.title};
                });
            },
            serverProvidersOptions() {
                return this.availableServerProviders.map(item => {
                    return {value: item.key, title: item.title};
                });
            },
        },
        components: {
            Head,
            BreezeAuthenticatedLayout,
            BreezeValidationErrors,
            AppLabel,
            AppInput,
            AppButton,
            AppSelect,
            InertiaLink,
        },
    };
</script>
