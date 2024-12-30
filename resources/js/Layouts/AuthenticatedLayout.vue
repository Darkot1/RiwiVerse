<script setup>
import { ref } from 'vue';
import TopNav from '@/Components/TopNav.vue';
import BottomNav from '@/Components/BottomNav.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-white">

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


