<script setup>
import {ref} from "vue";

defineProps({
    name: String,
    email: String,
    phone: String
})

const data = ref({
    name: null,
    email: null,
    phone: null,
    password: null,
    password_confirmation: null
})

const send = () => {
    axios.post(route('profile.edit'), data).then(response => console.log(response))
}
</script>

<template>
    <form @submit.prevent="send" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
            <input type="text" id="name" name="name"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                   v-model="data.name">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                   v-model="data.email">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
            <input type="tel" id="phone" name="phone"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                   v-model="data.phone">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Новый пароль</label>
            <input type="password" id="password" name="password"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                   v-model="data.password">
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Подтвердить
                пароль</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                   v-model="data.password_confirmation">
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
