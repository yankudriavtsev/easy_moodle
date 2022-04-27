<template>
    <select @change="$emit('update:modelValue', $event.target.value)">
        <option v-for="option in options" :value="option.value" :key="option.value">
            {{ option.title }}
        </option>
    </select>
</template>

<script>
    export default {
        props: {
            options: {
                type: Array,
                required: true
            }
        }
    };
</script>
