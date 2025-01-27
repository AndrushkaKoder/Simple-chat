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
    props: [
        "auth",
        "users"
    ],
    methods: {
        countUsers() {
            return Object.keys(this.users).length > 0
        },
        createChat(userListId) {
            this.$inertia.post('/chat/create', {
                who: this.auth.id,
                with: userListId
            });
        }
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
                        <p>{{ user.name }}</p>
                        <button @click="createChat(user.id)" v-if="user.email" class="text-gray-400 text-sm">
                            Начать чат с пользователем
                        </button>
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
