<script>
import { Link } from '@inertiajs/vue3';
import HeaderComponent from "@/Components/Chat/HeaderComponent.vue";
export default {
    components: {HeaderComponent, Link},
    data() {
        return {
            body: null
        }
    },
    props: {
        users: {
            type: Object
        },
    },
    methods: {
        countUsers() {
            return Object.keys(this.users).length > 0
        },
    }
}
</script>

<template>
    <HeaderComponent/>
    <div class="grid grid-cols-2">
        <div class="flex justify-center align-middle flex-col">
            <h2>Список пользователей:</h2>
            <div v-if="this.countUsers()">
                <div v-for="user in this.users">
                    <div>
                        <p>{{ user.email }}</p>
                        <span v-if="user.email" class="text-gray-400 text-sm">
                            Начать чат с пользователем
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <Link :href="route('chat.index')">Мои чаты</Link>
        </div>
    </div>
</template>

<style scoped>

</style>
