<script setup>
import {Link} from '@inertiajs/vue3';

const isHomePage = function () {
    return window.location.pathname === '/'
}
</script>

<template>
    <header class="grid px-10 py-5 header w-full">
        <div class="header_content flex justify-center align-middle">
<!--            <div class="logo">-->
<!--                <img :src="'images/logo.png'" alt="logo" class="w-10">-->
<!--            </div>-->
            <div class="menu flex justify-center items-center">
                <p v-if="isHomePage()" class="text-xl font-bold">
                    <Link :href="route('home')">Simple Chat</Link>
                </p>
                <p v-else class="text-xl font-bold">
                    <Link :href="route('home')">Моя страница</Link>
                </p>
            </div>
        </div>
    </header>
</template>

<style scoped>

</style>
