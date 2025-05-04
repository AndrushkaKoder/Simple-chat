<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Header',
    components: {
        Link
    },
    data() {
        return {
            title: 'SimpleChat',
            logo: 'images/logo.png'
        }
    },
    props: [
        'pageTitle'
    ],
    methods: {
        isHomePage() {
            return window.location.pathname === '/'
        },
    }
}
</script>

<template>
    <header class="flex shadow-md py-4 px-4 sm:px-10 bg-white min-h-[70px] tracking-wide relative z-50">
        <div class="flex flex-wrap items-center justify-between gap-5 w-full">
            <div class="logo flex items-center">
                <img src="/images/logo.png" alt="Logo"/>
                <p v-if="isHomePage()" class="text-xl font-bold">
                    {{ this.title }}
                </p>
                <p @click.prevent="change" v-else class="text-xl font-bold">
                    {{ this.pageTitle }}
                </p>
            </div>
            <div id="collapseMenu"
                 class="max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50">
                <button id="toggleClose"
                        class="lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border">

                </button>
            </div>
            <div class="flex max-lg:ml-auto space-x-4">
                <button
                    class="px-4 py-2 text-sm rounded-full font-medium tracking-wide text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all">
                    Профиль
                </button>
                <Link :href="route('logout')"  class="px-4 py-2 text-sm rounded-full font-medium tracking-wide text-slate-900 border border-gray-400 bg-transparent bg-red-400 hover:bg-gray-50 transition-all logout_btn">
                    Выйти
                </Link>
                <button id="toggleOpen" class="lg:hidden">
                    <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>
</template>

<style scoped>
.logo img {
    max-width: 50px;
}
</style>
