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

    <div class="flex h-[85vh] antialiased text-gray-800">
        <div class="flex flex-row h-full w-full overflow-x-hidden">
            <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">

                <div class="flex flex-col">
                    <div v-if="hasChats()">
                        <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48">

                            <div v-for="chat in this.chats.data"
                                 class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
                                <Link :href="route('chat.show', chat.slug)" class="flex items-center">
                                    <div class="flex items-center justify-center h-8 w-8 bg-gray-200 rounded-full">
                                        U
                                    </div>
                                    <div class="ml-2 text-sm font-semibold">
                                        {{ chat.chatUser.name }}
                                    </div>
                                </Link>
                                <div v-if="false"
                                     class="flex items-center justify-center ml-auto text-xs text-white bg-red-500 h-4 w-4 rounded leading-none">
                                    2
                                </div>
                            </div>

                        </div>
                    </div>
                    <div v-else>
                        <h3>Список чатов пуст, скорее напишите кому-нибудь из пользователей!</h3>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
