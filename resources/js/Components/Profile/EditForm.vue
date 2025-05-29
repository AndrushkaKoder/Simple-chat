<script setup>
import {onMounted, ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    name: String,
    email: String,
    phone: String,
    avatar: String
})

const form = useForm({
    name: props.name,
    email: props.email,
    phone: props.phone,
    avatar: props.avatar,
    password: null,
    password_confirmation: null,
})

const send = () => {
   form.put(route('profile.update'), {
       preserveScroll: true,
       onSuccess: () => form.reset(),
   })
}
</script>

<template>
    <form @submit.prevent="send" class="space-y-4">
        <div class="flex w-100 gap-3">
            <div class="photo w-1/2">
                <div class="flex justify-end items-center flex-col">
                    <div>
                        <img src="" alt="Profile Picture" class="rounded-full w-32 h-32 mx-auto border-4 border-indigo-800 mb-4 transition-transform duration-300 hover:scale-105 ring ring-gray-300">
<!--                        <input type="file" v-model="form.avatar" name="profile" id="upload_profile" hidden required>-->
                    </div>
                    <button class="bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition-colors duration-300 ring ring-gray-300 hover:ring-indigo-300">
                        Change Profile Picture
                    </button>
                </div>
            </div>
            <div class="info w-1/2">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                    <input type="text" id="name" name="name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                           v-model="form.name">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                           v-model="form.email">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
                    <input type="tel" id="phone" name="phone"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                           v-model="form.phone">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Новый пароль</label>
                    <input type="password" id="password" name="password"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                           v-model="form.password">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Подтвердить
                        пароль</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                           v-model="form.password_confirmation">
                </div>
            </div>

        </div>
        <div class="flex justify-end space-x-4">
            <button type="submit" class="px-4 py-2 bg-indigo-800 text-white rounded-lg hover:bg-indigo-700">
                Сохранить
            </button>
        </div>
    </form>
</template>

<style scoped>

</style>
