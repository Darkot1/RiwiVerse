<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    posts: {
        type: Array,
        default: () => [],
    }
});

console.log("Posts recibidos:", props.posts);

const showForm = ref(false);
const imagePreview = ref(null);

const form = useForm({
    content: '',
    image: null
});

const previewImage = (event) => {
    const file = event.target.files[0];
    if (file) {
        imagePreview.value = URL.createObjectURL(file);
        form.image = file;
    }
};

const submit = () => {
    form.post(route('post.store'), {
        onSuccess: () => {
            form.reset();
            imagePreview.value = null;
            showForm.value = false;
        },
    });
};
</script>

<template>
    <Head title="Mis Memes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Mis Memes
            </h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Formulario para subir memes -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                    <div class="p-6 sm:px-10 sm:py-6">
                        <button
                            @click="showForm = !showForm"
                            class="mb-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            {{ showForm ? 'Cancelar' : 'Subir meme' }}
                        </button>

                        <form v-if="showForm" @submit.prevent="submit" class="space-y-4">
                            <!-- Descripción -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                                <textarea
                                    v-model="form.content"
                                    rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Describe tu meme..."
                                ></textarea>
                            </div>

                            <!-- Selector de imagen -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Imagen</label>
                                <input
                                    type="file"
                                    @change="previewImage"
                                    accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100"
                                />
                            </div>

                            <!-- Vista previa -->
                            <div v-if="imagePreview" class="mt-4">
                                <img :src="imagePreview" alt="Vista previa" class="max-w-md rounded-lg shadow-md">
                            </div>

                            <!-- Botón submit -->
                            <div class="flex justify-end">
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50"
                                >
                                    Publicar meme
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Grid de memes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div v-for="post in posts" :key="post.id" class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Imagen -->
                        <img
                            :src="`/storage/${post.image}`"
                            :alt="post.content"
                            class="w-full h-64 object-cover"
                        >

                        <!-- Contenido -->
                        <div class="p-4">
                            <p class="text-gray-800">{{ post.content }}</p>

                            <!-- Info Usuario -->
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-sm font-medium">
                                            {{ post.user.name.charAt(0) }}{{ post.user.last_name.charAt(0) }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-600">
                                        {{ post.user.name }} {{ post.user.last_name }}
                                    </span>
                                </div>

                                <span class="text-sm text-gray-500">
                                    {{ new Date(post.created_at).toLocaleDateString() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
