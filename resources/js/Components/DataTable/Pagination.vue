<template>
    <div class="flex flex-wrap">
        <template v-for="(link, key) in links">
            <div v-if="link.url === null" :key="'a' + key" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
            <inertia-link v-else :key="key" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
        </template>
    </div>
</template>

<script>
    import {InertiaLink} from "@inertiajs/inertia-vue3";

    export default {
        props: {
            links: Array,
        },
        components : {
            InertiaLink
        }
    }
</script>
