<script setup>
defineProps({
    // TODO check for non=submit button
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="btn">
        <slot />
    </button>
</template>
