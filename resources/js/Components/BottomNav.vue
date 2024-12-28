<script setup>
import { ref } from "vue";
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

const showUserMenu = ref(false);

const toggleUserMenu = () => {
    showUserMenu.value = !showUserMenu.value;
};
</script>

<template>
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 sm:hidden">
        <div class="flex justify-around items-center h-16">
            <!-- General -->
            <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs">General</span>
            </NavLink>

            <!-- Amigos -->
            <NavLink :href="route('dashboard')" :active="route().current('amigos')" class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="text-xs">Amigos</span>
            </NavLink>

            <!-- Privados -->
            <NavLink :href="route('dashboard')" :active="route().current('privados')" class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-xs">Privados</span>
            </NavLink>

            <!-- Usuario con Dropdown -->
            <div class="relative">
                <button @click="toggleUserMenu" class="flex flex-col items-center text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-xs">Usuario</span>
                </button>

                <!-- Menú Dropdown -->
                <div v-if="showUserMenu" class="absolute bottom-full mb-2 right-0 w-48 py-2 bg-white rounded-lg shadow-xl border border-gray-100">
                    <Link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Perfil
                    </Link>
                    <Link :href="route('logout')" method="post" as="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Cerrar Sesión
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>
