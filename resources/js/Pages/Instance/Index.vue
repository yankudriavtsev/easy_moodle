<template>
    <Head>
        <title>Instances</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Instances
            </h2>
        </template>


        <data-table
            :items="items"
            :columns="columns"
            :panel-configuration="{actions: [{url: route('instances.create'), title: 'Create'}]}"
        />
    </AuthenticatedLayout>
</template>

<script>
    import {Head} from "@inertiajs/inertia-vue3";
    import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import DataTable from "@/Components/DataTable/Index";
    import TableRowActions from "@/Pages/Instance/Components/TableRowActions";
    import {markRaw} from "vue";

    export default {
        props: {
            items: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                columns: [
                    {title: 'Name', key: 'name'},
                    {title: 'Moodle version', key: 'moodle_version'},
                    {title: 'Server provider', key: 'server_provider'},
                    {
                        title: 'Actions',
                        component: markRaw(TableRowActions),
                        getProps(row) {
                            return {id: row.id}
                        }
                    }
                ]
            };
        },
        components: {
            Head,
            AuthenticatedLayout,
            DataTable,
        },
    };
</script>
