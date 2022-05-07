<template>
    <div class="inline-flex rounded-md shadow-sm" role="group">
        <inertia-link :href="route('instances.edit', {instance: id})" class="btn mr-2">
            Edit
        </inertia-link>
        <app-button type="submit" @click="deleteInstance">Delete</app-button>
    </div>
</template>

<script>
    import {InertiaLink} from "@inertiajs/inertia-vue3";
    import AppButton from "@/Components/Button";

    export default {
        props: {
            id: {
                type: Number,
                required: true
            },
        },
        methods: {
            deleteInstance() {
                if (confirm('Are you sure you want to delete this instance?')) {
                    this.$inertia.visit(route('instances.destroy', {instance: this.id}), {
                        method: 'delete'
                    });
                }
            }
        },
        components: {
            AppButton,
            InertiaLink,
        },
    };
</script>
