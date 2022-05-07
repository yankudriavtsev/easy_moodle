<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <panel class="p-4" :configuration="panelConfiguration" />
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3" v-for="column in columns">
                        {{ column.title }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-if="!items.data.length">
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td :colspan="columns.length" class="px-6 py-4 text-center text-lg">
                            No records
                        </td>
                    </tr>
                </template>

                <template v-else>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-for="(row, index) in items.data"
                        :key="'tbl_row' + index"
                    >
                        <td v-for="column in columns" class="px-6 py-4">
                            <template v-if="column.component">
                                <component :is="column.component" v-bind="column.getProps(row)" />
                            </template>
                            <template v-else>
                                {{ row[column.key] }}
                            </template>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <pagination class="mt-3" :links="items.links"></pagination>
</template>

<script>
    import Pagination from "@/Components/DataTable/Pagination";
    import Panel from "./Panel";

    export default {
        props: {
            columns: {
                type: Array,
                required: true,
            },
            items: {
                type: Object,
                required: true
            },
            panelConfiguration: {
                type: Object,
                default: () => ({})
            },
        },
        components: {
            Pagination,
            Panel,
        },
    };
</script>
