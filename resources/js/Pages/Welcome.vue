<script>
import HeaderComponent from "@/Components/Chat/HeaderComponent.vue";
import {Link} from "@inertiajs/vue3";
import ChatLink from "@/Components/Chat/ChatLink.vue";

export default {
    name: 'Welcome',
    components: {
        ChatLink,
        HeaderComponent,
        Link
    },
    data() {
        return {}
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

            <div class="flex flex-col py-8 pl-6 pr-2 w-96 bg-white flex-shrink-0">

                <div class="flex flex-col">
                    <div v-if="hasChats()">
                        <ChatLink :data="chats"/>
                    </div>
                    <div v-else>
                        <h3>Список чатов пуст, скорее напишите кому-нибудь из пользователей!</h3>
                    </div>
                </div>
            </div>

            <div class="flex flex-col flex-auto h-full p-6">
                <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                    <div class="flex flex-col h-full overflow-x-auto mb-4">
                        <div class="flex flex-col h-full items-center justify-center">
                            Выберите кому написать
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</template>

<style scoped>

</style>
