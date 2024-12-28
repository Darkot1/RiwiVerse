<script setup>
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

defineProps({
    user: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <nav class="border-b border-gray-100 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <Link :href="route('dashboard')">
                        <h1 class="text-4xl font-bold text-gray-800">RiwiVerse</h1>
                    </Link>
                </div>

                <!-- Links Escritorio -->
                <div class="hidden sm:flex items-center justify-center flex-1 space-x-4">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        General
                    </NavLink>
                    <div class="h-6 w-px bg-gray-300"></div>
                    <NavLink :href="route('dashboard')" :active="route().current('amigos')">
                        Amigos
                    </NavLink>
                    <div class="h-6 w-px bg-gray-300"></div>
                    <NavLink :href="route('dashboard')" :active="route().current('privados')">
                        Privados
                    </NavLink>
                </div>

                <!-- Notificaciones y Perfil -->
                <div class="sm:flex items-center space-x-4">
                    <!-- Icono Notificaciones -->
                    <button class="text-gray-600 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <div class="hidden sm:flex items-center space-x-4">
                        <!-- Foto/Iniciales del usuario -->
                        <div class="flex items-center">
                            <div v-if="user.profile_picture" class="h-8 w-8 rounded-full overflow-hidden">
                                <img :src="user.profile_picture" alt="profile" class="h-full w-full object-cover" />
                            </div>
                            <div v-else class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-sm font-medium text-gray-700">
                                    {{ user.name.charAt(0) }}{{ user.last_name.charAt(0) }}
                                </span>
                            </div>
                        </div>
                        <!-- Botón Cerrar Sesión -->
                        <Link :href="route('logout')" method="post" as="button" class="text-sm text-gray-600 hover:text-gray-900">
                            Cerrar Sesión
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
