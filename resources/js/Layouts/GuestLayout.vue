<script setup>
import Eslogan from '@/Components/Eslogan.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-gray-200 sm:flex sm:items-center sm:justify-evenly p-6">
        <template v-if="$page.url === '/login' || $page.url === '/'">
            <div class="flex-shrink-0 mr-14">
                <Link href="/">
                    <Eslogan />
                </Link>
            </div>
            <div class="w-full overflow-hidden bg-white px-6 py-6 shadow-md sm:max-w-md sm:rounded-lg border border-stone-950">
                <slot />
            </div>
        </template>

        <template v-else>
            <div class="w-full overflow-hidden bg-white px-8 py-12 shadow-md sm:max-w-2xl sm:rounded-lg border border-stone-950">
                <slot />
            </div>
            <div class="flex-shrink-0 ml-14">
                <Link href="/">
                    <Eslogan />
                </Link>
            </div>
        </template>
    </div>
</template>
