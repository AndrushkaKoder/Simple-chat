<script>
import HeaderComponent from "@/Components/Chat/HeaderComponent.vue";
import {Link} from "@inertiajs/vue3";

export default {
    components: {
        HeaderComponent,
        Link
    },
    data() {
        return {

        }
    },
    props: [
        'user',
        'chats'
    ],
    methods: {
        hasChats() {
            return Object.keys(this.chats).length > 0
        }

    },
}
</script>

<template>
    <HeaderComponent/>

    <div class="flex h-screen antialiased text-gray-800">
        <div class="flex flex-row h-full w-full overflow-x-hidden">
            <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">

                <div class="flex flex-col">
                    <div v-if="hasChats()">
                        <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48">

                            <button
                                class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2"
                            >
                                <div
                                    class="flex items-center justify-center h-8 w-8 bg-gray-200 rounded-full"
                                >
                                    M
                                </div>
                                <div class="ml-2 text-sm font-semibold">Marta Curtis</div>
                                <div
                                    class="flex items-center justify-center ml-auto text-xs text-white bg-red-500 h-4 w-4 rounded leading-none"
                                >
                                    2
                                </div>
                            </button>
                            <button
                                class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2"
                            >
                                <div
                                    class="flex items-center justify-center h-8 w-8 bg-purple-200 rounded-full"
                                >
                                    J
                                </div>
                                <div class="ml-2 text-sm font-semibold">Jerry Guzman</div>
                            </button>
                        </div>
                    </div>
                    <div v-else>
                        <h3>Список чатов пуст, скорее напишите кому-нибудь из пользователей!</h3>
                        <Link :href="route('home')">Мои чаты</Link>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
