<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from "@/Components/Default/InputError.vue";
import TextInput from "@/Components/Default/TextInput.vue";
import Checkbox from "@/Components/Default/Checkbox.vue";
import AuthPage from "@/Components/Default/AuthPage.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: true,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="h-screen md:flex">
        <AuthPage/>
        <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
            <form class="bg-white" @submit.prevent="submit">
                <h1 class="text-gray-800 font-bold text-2xl mb-3 text-center    ">Войти в чат</h1>

                <div>
                    <div class="flex items-center border-none gap-2 py-2 rounded-2xl mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                        </svg>
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="email"
                            placeholder="Email"
                        />
                    </div>
                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>

                <div>
                    <div class="flex items-center border-none gap-2 py-2 rounded-2xl mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                            autocomplete="password"
                            placeholder="Пароль"
                        />
                    </div>
                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>

                <div class="mt-4 block">
                    <label class="flex items-center justify-center mb-5">
                        <Checkbox
                            name="remember"
                            v-model:checked="form.remember"
                        />
                        <span class="ms-2 text-sm text-gray-600"
                        >Запомнить меня</span
                        >
                    </label>
                </div>

                <button type="submit" class="block w-full bg-indigo-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Войти</button>
                <div class="w-100 flex justify-center mt-3">
                    <a href="/register" type="submit" class="block w-full text-center bg-purple-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Регистрация</a>
                </div>

            </form>
        </div>
    </div>
</template>
