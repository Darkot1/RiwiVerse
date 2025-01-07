<script setup>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const layout = ref(null);

const toggleTheme = () => {
    if (layout.value) {
        layout.value.toggleDarkMode();
    }
};

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    countries: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <Head title="Perfil" />

    <AuthenticatedLayout ref="layout">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Perfil
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex gap-6">
                    <!-- Sidebar -->
                    <div class="w-64 bg-white shadow sm:rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Configuraciones</h3>

                        <!-- Menú de navegación -->
                        <nav class="space-y-2">
                            <a href="#profile" class="flex items-center space-x-2 p-2 rounded-lg text-gray-700 hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <span>Perfil</span>
                            </a>

                            <a href="#friends" class="flex items-center space-x-2 p-2 rounded-lg text-gray-700 hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                                <span>Amigos</span>
                            </a>

                            <button 
                                @click="toggleTheme"
                                class="w-full flex items-center justify-between p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800"
                            >
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                    </svg>
                                    <span>Modo Oscuro</span>
                                </div>
                                <div class="w-9 h-5 flex items-center bg-gray-300 rounded-full p-1" 
                                    :class="{ 'bg-blue-600': layout?.darkMode }">
                                    <div class="w-4 h-4 bg-white rounded-full shadow-md transform transition-transform duration-200"
                                        :class="{ 'translate-x-4': layout?.darkMode }">
                                    </div>
                                </div>
                            </button>

                            <div class="pt-4 mt-4 border-t border-gray-200">
                                <Link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    class="w-full flex items-center space-x-2 p-2 rounded-lg text-red-600 hover:bg-red-50"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Cerrar Sesión</span>
                                </Link>
                            </div>
                        </nav>
                    </div>

                    <!-- Contenido principal -->
                    <div class="flex-1 space-y-6">
                        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                                :countries="countries"
                                class="max-w-xl"
                            />
                        </div>

                        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                            <UpdatePasswordForm class="max-w-xl" />
                        </div>

                        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                            <DeleteUserForm class="max-w-xl" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
