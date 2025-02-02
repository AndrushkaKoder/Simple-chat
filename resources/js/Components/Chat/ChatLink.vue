<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "ChatLink",
    components: {Link},
    props: [
        'data'
    ],
    methods: {
        isActiveChat(chat) {
            let currentChatUrl = window.location.pathname.replace('/chat/', '');
            return currentChatUrl === chat.slug
        },
    }
}
</script>

<template>
    <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48">

        <div v-for="chat in this.data.data"
             v-bind:class="{ active_chat: isActiveChat(chat) }"
             class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
            <Link :href="route('chat.show', chat.slug)"
                  class="flex items-center w-full"
            >
                <div class="flex items-center justify-center h-8 w-8 bg-gray-200 rounded-full">
                    M
                </div>
                <div class="flex flex-col justify-center items-center">
                    <div class="ml-2 text-sm font-semibold">
                        {{ chat.chatUser.name }}
                    </div>
                    <div v-if="chat.messages.length > 0" class="text-gray-600 text-xs px-3 py-1">
                        {{ chat.messages[chat.messages.length - 1].body }}
                    </div>
                </div>
            </Link>
            <div v-if="false"
                 class="flex items-center justify-center ml-auto text-xs text-white bg-red-500 h-4 w-4 rounded leading-none">
                2
            </div>
        </div>

    </div>
</template>

<style scoped>
.active_chat {
    background: deepskyblue;
}


</style>
