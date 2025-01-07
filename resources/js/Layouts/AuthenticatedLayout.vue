<script setup>
import { ref, onMounted } from 'vue';
import TopNav from '@/Components/TopNav.vue';
import BottomNav from '@/Components/BottomNav.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const darkMode = ref(false);

onMounted(() => {
    darkMode.value = localStorage.getItem('darkMode') === 'true';
    applyTheme();
});

const toggleDarkMode = () => {
    darkMode.value = !darkMode.value;
    localStorage.setItem('darkMode', darkMode.value);
    applyTheme();
};

const applyTheme = () => {
    if (darkMode.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

defineExpose({ darkMode, toggleDarkMode });
</script>

<template>
    <div :class="{ 'dark': darkMode }">
        <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">

            <TopNav :user="$page.props.auth.user" />

            <header
                class="bg-white shadow"
                v-if="$slots.header"
            >
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <main>
                <slot />
            </main>

            <BottomNav />

        </div>
    </div>
</template>


