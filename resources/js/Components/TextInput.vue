<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="w-full border-0 border-b-2 border-gray-300 focus:border-gray-500 focus:ring-0 focus:outline-none bg-transparent py-2 transition-colors duration-300 dark:border-gray-700 dark:text-gray-100 dark:focus:border-blue-500"
        v-model="model"
        ref="input"
    />
</template>
