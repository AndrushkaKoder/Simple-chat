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

    <div class="font-std mb-10 w-full rounded-2xl bg-white p-10 font-normal leading-relaxed text-gray-900">

        <div class="flex flex-col">
            <div class="flex flex-col md:flex-row justify-between mb-5 items-start">
                <h2 class="mb-5 text-4xl font-bold text-blue-900">{{ user.name }}</h2>
            </div>
            <EditForm
                :name="user.name"
                :email="user.email"
                :phone="user.phone"
            />
        </div>

    </div>
</template>
