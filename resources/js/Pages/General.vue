<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
  posts: {
    type: Array,
    required: true,
    default: () => [],
  },
});

const handleImageError = (e, name, lastName) => {
    e.target.src = `https://ui-avatars.com/api/?name=${name}+${lastName}&color=7F9CF5&background=EBF4FF`;
};

console.log("Posts recibidos:", props.posts);
</script>

<template>
    <Head title="Memes Generales" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Memes Generales
        </h2>
      </template>

      <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 gap-6 md:gap-8">
            <!-- Post Card -->
            <div
              v-for="post in props.posts"
              :key="post.id"
              class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 transition-all duration-300 hover:shadow-xl"
            >
              <!-- Header con info de usuario -->
              <div class="p-4 flex items-center justify-between border-b border-gray-100">
                <div class="flex items-center space-x-3">
                  <div v-if="post.user?.profile_picture" class="h-10 w-10 rounded-full overflow-hidden ring-2 ring-gray-200 dark:ring-gray-700">
                    <img 
                      :src="`/storage/${post.user.profile_picture}`"
                      :alt="post.user.name"
                      class="h-full w-full object-cover"
                      @error="handleImageError($event, post.user.name, post.user.last_name)"
                    />
                  </div>
                  <div v-else class="h-10 w-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                    <span class="text-xl font-medium text-gray-700 dark:text-gray-200">
                      {{ post.user?.name?.charAt(0) }}{{ post.user?.last_name?.charAt(0) }}
                    </span>
                  </div>
                  <div class="flex flex-col">
                    <span class="text-xl font-medium text-gray-900">
                      {{ post.user?.name }} {{ post.user?.last_name }}
                    </span>
                    <span class="text-xs text-gray-500">
                      {{ new Date(post.created_at).toLocaleDateString() }}
                    </span>
                  </div>
                </div>
              </div>

              <!-- Contenido -->
              <p class="px-4 py-3 text-gray-800">{{ post.content }}</p>

              <!-- Imagen -->
              <div class="px-4 pb-4">
                <img
                  :src="`/storage/${post.image}`"
                  :alt="post.content"
                  class="w-full h-auto max-h-[32rem] object-contain rounded-lg border border-gray-200"
                />
              </div>

              <!-- Botones de interacción -->
              <div class="px-4 py-3 border-t border-gray-100 flex items-center justify-between">
                <button
                  class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-colors"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span class="text-sm font-medium">Me gusta</span>
                </button>

                <button
                  class="flex items-center space-x-2 text-gray-600 hover:text-red-600 transition-colors"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span class="text-sm font-medium">No me gusta</span>
                </button>

                <button
                  class="flex items-center space-x-2 text-gray-600 hover:text-green-600 transition-colors"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span class="text-sm font-medium">Comentarios</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
