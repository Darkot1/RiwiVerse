<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    countries: {
        type: Array,
        required: true
    }
});

const user = usePage().props.auth.user;

const form = useForm({
    _method: 'PATCH',
    name: user.name,
    last_name: user.last_name,
    username: user.username,
    email: user.email,
    type: user.type,
    bio: user.bio,
    profile_picture: null,
    country_id: user.country_id
});

const submit = () => {
    if (form.profile_picture) {
        let formData = new FormData();
        formData.append('profile_picture', form.profile_picture);
        formData.append('_method', 'PATCH');
        
        form.post(route('profile.update'), {
            preserveScroll: true,
            forceFormData: true
        });
    } else {
        form.patch(route('profile.update'));
    }
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Información del Perfil</h2>
            <p class="mt-1 text-sm text-gray-600">Actualiza la información de tu perfil.</p>
        </header>

        <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-6 space-y-6">
            <!-- Biografía movida arriba -->
            <div class="mb-6">
                <InputLabel for="bio" value="Biografía" />
                <textarea
                    v-model="form.bio"
                    id="bio"
                    rows="4"
                    placeholder="Cuenta sobre ti..."
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                ></textarea>
                <InputError :message="form.errors.bio" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <InputLabel for="name" value="Nombre" />
                    <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="last_name" value="Apellido" />
                    <TextInput id="last_name" v-model="form.last_name" type="text" class="mt-1 block w-full" />
                    <InputError :message="form.errors.last_name" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="username" value="Nombre de usuario" />
                    <TextInput id="username" v-model="form.username" type="text" class="mt-1 block w-full" />
                    <InputError :message="form.errors.username" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="email" value="Correo electrónico" />
                    <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="type" value="Género" />
                    <select v-model="form.type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="male">Masculino</option>
                        <option value="female">Femenino</option>
                        <option value="other">Otro</option>
                    </select>
                    <InputError :message="form.errors.type" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="country_id" value="País" />
                    <select
                        v-model="form.country_id"
                        id="country_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    >
                        <option value="">Selecciona un país</option>
                        <option v-for="country in countries" :key="country.id" :value="country.id">
                            {{ country.name }}
                        </option>
                    </select>
                    <InputError :message="form.errors.country_id" class="mt-2" />
                </div>

                <div class="sm:col-span-2">
                    <InputLabel for="profile_picture" value="Foto de perfil" />
                    <input
                        type="file"
                        @change="form.profile_picture = $event.target.files[0]"
                        accept="image/*"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    />
                    <InputError :message="form.errors.profile_picture" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Guardar</PrimaryButton>
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Guardado.</p>
            </div>
        </form>
    </section>
</template>
