<template>
    <table class="mb-3 w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th class="px-6 py-3" v-for="column in columns">
                {{ column.title }}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            v-for="(item, index) in items.data"
            :key="'tbl_row' + index"
        >
            <td class="px-6 py-4" v-for="column in columns">
                {{ item[column.key] }}
            </td>
        </tr>
        </tbody>
    </table>
    <pagination :links="items.links"></pagination>
</template>

<script>
    import Pagination from "@/Components/DataTable/Pagination";

    export default {
        props: {
            columns: {
                type: Array,
                required: true,
            },
            items: {
                type: Object,
                required: true
            }
        },
        components: {
            Pagination,
        },
    };
</script>
