<script setup>
import HeaderComponent from "@/Components/Chat/HeaderComponent.vue";
import EditForm from "@/Components/Profile/EditForm.vue";
import {ref} from "vue";

const title = 'Профиль'
defineProps({
    user: Object,
});
</script>

<template>
<HeaderComponent :pageTitle="title" :go-back-link="true"/>

    <div class="font-std mb-10 w-full rounded-2xl bg-white p-10 font-normal leading-relaxed text-gray-900 shadow-xl">

        <div class="flex flex-col">
            <div class="flex flex-col md:flex-row justify-between mb-5 items-start">
                <h2 class="mb-5 text-4xl font-bold text-blue-900">{{ user.name }}</h2>
                <div class="text-center">
                    <div>
                        <img src="" alt="Profile Picture" class="rounded-full w-32 h-32 mx-auto border-4 border-indigo-800 mb-4 transition-transform duration-300 hover:scale-105 ring ring-gray-300">
                        <input type="file" name="profile" id="upload_profile" hidden required>

                        <label for="upload_profile" class="inline-flex items-center">
                            <svg data-slot="icon" class="w-5 h-5 text-blue-700" fill="none" stroke-width="1.5"
                                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                 aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z">
                                </path>
                            </svg>
                        </label>
                    </div>
                    <button class="bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition-colors duration-300 ring ring-gray-300 hover:ring-indigo-300">
                        Change Profile Picture
                    </button>
                </div>
            </div>
            <EditForm
                :name="user.name"
                :email="user.email"
                :phone="user.phone"
            />
        </div>

    </div>

</template>
