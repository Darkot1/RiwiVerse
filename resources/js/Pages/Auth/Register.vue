<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    last_name: '',
    username: '',
    email: '',
    country_id: '',
    type: '',
    password: '',
    password_confirmation: '',
});

const genderOptions = [
    { value: 'male', label: 'Masculino' },
    { value: 'female', label: 'Femenino' },
    { value: 'other', label: 'Otro' }
];

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const props = defineProps({
    countries: {
        type: Array,
        required: true
    }
});

console.log('Countries:', props.countries);
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div>
                        <InputLabel for="name" value="Nombre" />
                        <TextInput
                            id="name"
                            type="text"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div>
                        <InputLabel for="country_id" value="País" />
                        <select
                            id="country_id"
                            v-model="form.country_id"
                            class="w-full border-0 border-b-2 border-gray-300 focus:border-gray-500 focus:ring-0 focus:outline-none bg-transparent py-2 transition-colors duration-300"
                            required
                        >
                            <option value="">Selecciona un país</option>
                            <option v-for="country in countries" :key="country.id" :value="country.id">
                                {{ country.name }}
                            </option>
                        </select>
                        <InputError :message="form.errors.country_id" />
                    </div>

                    <div>
                        <InputLabel for="username" value="Usuario" />
                        <TextInput
                            id="username"
                            type="text"
                            v-model="form.username"
                            required
                            autocomplete="username"
                        />
                        <InputError :message="form.errors.username" />
                    </div>

                    <div>
                        <InputLabel for="password" value="Contraseña" />
                        <TextInput
                            id="password"
                            type="password"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <InputLabel for="last_name" value="Apellido" />
                        <TextInput
                            id="last_name"
                            type="text"
                            v-model="form.last_name"
                            required
                            autocomplete="last_name"
                        />
                        <InputError :message="form.errors.last_name" />
                    </div>

                    <div>
                        <InputLabel for="type" value="Género" />
                        <select
                            id="type"
                            v-model="form.type"
                            class="w-full border-0 border-b-2 border-gray-300 focus:border-gray-500 focus:ring-0 focus:outline-none bg-transparent py-2 transition-colors duration-300"
                            required
                        >
                            <option value="">Selecciona un género</option>
                            <option v-for="option in genderOptions" :key="option.value" :value="option.value">
                                {{ option.label }}
                            </option>
                        </select>
                        <InputError :message="form.errors.type" />
                    </div>

                    <div>
                        <InputLabel for="email" value="Correo" />
                        <TextInput
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div>
                        <InputLabel for="password_confirmation" value="Confirmar contraseña" />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-col items-center space-y-4">
                <button
                    class="max-w-xs bg-blue-800 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2 hover:bg-blue-700 transition-colors"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    <span>Crear cuenta</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <Link
                    :href="route('login')"
                    class="text-sm text-blue-600 hover:text-blue-900"
                >
                    <span>¿Ya tienes una cuenta?</span>
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
