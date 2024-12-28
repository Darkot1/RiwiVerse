<script setup>
</script>

<template>
    <div class="flex items-center">
        <div v-if="$page.url === '/login' || $page.url === '/'">
            <h1 class="text-4xl font-bold text-gray-800">RiwiVerse</h1>
            <div class="text-2xl text-gray-600 mt-6">
                <p>La red social de memes</p>
                <p>de desarrolladores</p>
            </div>
        </div>
        <div v-else-if="$page.url === '/register'" class="flex flex-col">
            <h1 class="text-4xl font-bold text-gray-800">RiwiVerse</h1>
            <div class="text-2xl text-gray-600 mt-6 flex flex-col gap-2">
                <p>Haz parte de una</p>
                <p>comunidad de</p>
                <p>desarrolladores, respetuosa</p>
                <p>pero con buen sentido del humor.</p>
            </div>
        </div>
    </div>
</template>
