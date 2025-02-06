<script>
import HeaderComponent from "@/Components/Chat/HeaderComponent.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";
import Message from "@/Components/Chat/Message.vue";
import ChatLink from "@/Components/Chat/ChatLink.vue";
import Search from "@/Components/Chat/Search.vue";

export default {
    components: {
        Search,
        ChatLink,
        Message,
        HeaderComponent,
        Link,
    },
    data() {
        return {
            body: '',
            file: null,
            messages: null
        }
    },
    props: [
        'auth',
        'chats',
        'currentChat'
    ],
    methods: {
        hasChats() {
            return Object.keys(this.chats).length > 0
        },
        chatMessages() {
            return this.currentChat.data.messages
        },
        hasMessages() {
            return Object.keys(this.currentChat.data.messages).length > 0
        },
        uploadFile(event) {
            this.file = event.target.files[0]
        },
        sendMessage() {
            const formData = new FormData();
            formData.append('file', this.file)
            formData.append('body', this.body.trim())
            formData.append('chat_id', this.currentChat.data.id)
            axios.post('/message/create', formData, {
                'Content-Type': 'multipart/form-data',
            }).then(res => {
                if (res.status === 200 || res.status === 201) {
                    this.clearInput()
                    this.$refs.messageInput.value = ''
                    this.currentChat.data.messages.push(res.data.data)
                    this.scrollToLastMessage()
                }
            }).catch(ex => {
                console.error(ex)
            })
        },
        scrollToLastMessage() {
            const anchor = this.$refs.scrollAnchor;
            if (anchor) {
                anchor.scrollIntoView()
            }
        },
        clearInput() {
            this.body = '';
        },
        readChatMessages() {
            axios.get(`/chat/${this.currentChat.data.id}/read`).then(res => {
                console.log(res)
            })
        }
    },
    computed() {
        this.messages = this.currentChat.data.messages
    },
    mounted() {
        this.scrollToLastMessage()
        this.$refs.messageInput.focus()
        this.readChatMessages()
    },
}
</script>

<template>
    <HeaderComponent :page-title="this.currentChat.data.chatUser.name"/>

    <div class="flex h-[85vh] antialiased text-gray-800">
        <div class="flex flex-row h-full w-full overflow-x-hidden">
            <div class="flex flex-col py-8 pl-6 pr-2 w-96 bg-white flex-shrink-0">

                <Search/>

                <div class="flex flex-col">
                    <div v-if="hasChats()">
                        <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48">
                            <ChatLink :data="chats"/>
                        </div>
                    </div>
                    <div v-else>
                        <h3>Список чатов пуст, скорее напишите кому-нибудь из пользователей!</h3>
                    </div>
                </div>

            </div>
            <div class="flex flex-col flex-auto h-full p-6">
                <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">

                    <div class="flex flex-col h-full overflow-x-auto mb-4">
                        <div v-if="this.hasMessages()" class="flex flex-col h-full">
                            <div v-for="message in this.chatMessages()" class="grid grid-cols-12 gap-y-2 message_items">

                                <Message :data="message"/>

                            </div>
                            <div ref="scrollAnchor" class="scroll-anchor"></div>
                        </div>
                        <div v-else class="flex flex-col h-full items-center justify-end">
                            <div>
                                <h2 class="text-xl">Сообщений нет</h2>
                            </div>
                        </div>
                    </div>

                    <form @submit.prevent="sendMessage()">
                        <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
                            <div>
                                <label class="block">
                                    <span class="sr-only">Choose profile photo</span>
                                    <input @change="uploadFile" type="file" class="block w-full text-sm text-gray-500
                                        file:me-4 file:py-2 file:px-4
                                        file:rounded-lg file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-blue-600 file:text-white
                                        hover:file:bg-blue-700
                                        file:disabled:opacity-50 file:disabled:pointer-events-none
                                        dark:text-neutral-500
                                        dark:file:bg-blue-500
                                        dark:hover:file:bg-blue-400
                                        ">
                                </label>
                            </div>
                            <div class="flex-grow ml-4">
                                <div class="relative w-full">
                                    <input ref="messageInput" v-model="this.body"
                                           type="text"
                                           class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10"/>
                                    <button
                                        class="absolute flex items-center justify-center h-full w-12 right-0 top-0 text-gray-400 hover:text-gray-600">
                                        <svg
                                            class="w-6 h-6"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="ml-4">
                                <button
                                    class="flex items-center justify-center bg-blue-600 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                                    <span>Отправить</span>
                                    <span class="ml-2">
                                      <svg
                                          class="w-4 h-4 transform rotate-45 -mt-px"
                                          fill="none"
                                          stroke="currentColor"
                                          viewBox="0 0 24 24"
                                          xmlns="http://www.w3.org/2000/svg"
                                      >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                        ></path>
                                      </svg>
                                 </span>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.hidden {
    display: none !important;
}

.scroll-anchor {
    height: 1px;
}
</style>
