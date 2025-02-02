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
    <header class="grid px-10 py-5 header w-full">
        <div class="header_content flex justify-start align-middle">
                        <div class="logo">
                            <img src="/images/logo.png" alt="Logo" />
                        </div>
            <div class="menu flex justify-center items-center">
                <p v-if="isHomePage()" class="text-xl font-bold">
                   {{ this.title }}
                </p>
                <p @click.prevent="change" v-else class="text-xl font-bold">
                   {{ this.pageTitle }}
                </p>
            </div>
        </div>
    </header>
</template>

<style scoped>
.logo img {
    max-width: 50px;
}
</style>
