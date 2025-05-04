<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "ChatLink",
    components: {Link},
    props: [
        'chatsList'
    ],
    methods: {
        isActiveChat(chat) {
            let currentChatUrl = window.location.pathname.replace('/chat/', '');
            return currentChatUrl === chat.slug
        },
        unreadMessages(messages) {
            let unread = 0
            messages.forEach(el => {
                if (!el.is_read && !el.is_inner) {
                    unread++
                }
            })
            return unread;
        },
    }
}
</script>

<template>
    <div class="flex flex-col space-y-1 mt-4 h-48 links_list">
        <div v-for="chat in this.chatsList.data"
             v-bind:class="{ active_chat: isActiveChat(chat) }"
             class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-3 h-[60px]">
            <Link :href="route('chat.show', chat.slug)"
                  class="flex items-center w-full gap-5"
            >
                <div class="flex items-center justify-center h-8 w-8 bg-gray-200 rounded-full">
                    M
                </div>
                <div class="flex flex-col justify-center items-start">
                    <div class="ml-2 text-sm font-semibold">
                        {{ chat.chatUser.name }}
                    </div>
                    <div v-if="chat.messages.length > 0" class="text-gray-600 text-xs px-3 py-1">
                        <span v-if="chat.messages[chat.messages.length - 1].is_inner" class="font-bold">
                            You:
                        </span>
                        {{ chat.messages[chat.messages.length - 1].body.slice(0, 20) + '...' }}
                    </div>
                </div>
            </Link>
            <div v-if="this.unreadMessages(chat.messages)"
                 class="flex items-center justify-center ml-auto text-xs text-white bg-red-500 h-4 w-4 rounded leading-none">
                {{ this.unreadMessages(chat.messages) }}
            </div>
        </div>
    </div>
</template>

<style scoped>
.active_chat {
    background: deepskyblue;
}
</style>
