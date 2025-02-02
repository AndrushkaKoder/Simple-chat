<script>
import HeaderComponent from "@/Components/Chat/HeaderComponent.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    components: {
        HeaderComponent,
        Link,
    },
    data() {
        return {
            body: '',
            file: null
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
        hasFiles(message) {
            return message.file !== null
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
                console.log(res)
            }).catch(ex => {
                console.error(ex)
            })
        },
        messageActions(event) {
            event.preventDefault()
            document.querySelector('.settings_menu').classList.toggle('hidden')
        },
        removeMessage(messageObject) {
            console.log(this.chatMessages())
            if (confirm('Сообщение будет удалено, вы уверены?')) {
                axios.delete(`/message/${messageObject.id}/delete`).then(res => {
                    if (res.status === 200) {

                        let indexToRemove = this.chatMessages().findIndex(message => {
                            return message.id === messageObject.id
                        })
                        this.chatMessages().splice(indexToRemove, 1);

                        alert('Сообщение успешно удалено!')
                    }
                }).catch(error => {
                    console.error(error)
                })
            }
        }
    },
    created() {

    }
}
</script>

<template>
    <HeaderComponent/>

    <div class="flex h-[90vh] antialiased text-gray-800">
        <div class="flex flex-row h-full w-full overflow-x-hidden">
            <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">

                <div class="flex flex-col">
                    <div v-if="hasChats()">
                        <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48">

                            <div v-for="chat in this.chats.data"
                                 class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
                                <Link :href="route('chat.show', chat.slug)" class="flex items-center">
                                    <div class="flex items-center justify-center h-8 w-8 bg-gray-200 rounded-full">
                                        M
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
            <div class="flex flex-col flex-auto h-full p-6">
                <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                    <div class="flex flex-col h-full overflow-x-auto mb-4">
                        <div v-if="this.hasMessages()" class="flex flex-col h-full">
                            <div v-for="message in this.chatMessages()" class="grid grid-cols-12 gap-y-2">
                                <!-- messages-->
                                <div v-if="!message.is_inner" class="col-start-1 col-end-8 p-3 rounded-lg">
                                    <div class="flex flex-row items-center">
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                            A
                                        </div>
                                        <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                            <div>{{ message.body }}</div>
                                            <div class="text-xs text-gray-400">{{ message.created_at }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div v-else class="col-start-6 col-end-13 p-3 rounded-lg">
                                    <div class="flex items-center justify-start flex-row-reverse">
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                            A
                                        </div>
                                        <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                            <div>{{ message.body }}</div>
                                            <div v-if="this.hasFiles(message)">
                                                <a :href="message.file" target="_blank" class="text-blue-500">Файл</a>
                                            </div>
                                            <div class="text-xs text-gray-400">{{ message.created_at }}</div>
                                            <div class="absolute text-xs bottom-0 right-0 -mb-5 mr-2 text-gray-400">
                                                Not read / Read
                                            </div>
                                        </div>
                                        <div class="px-2 pt-2 pb-4 bg-white shadow-lg settings_menu hidden">
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li>
                                                        <button @click="removeMessage(message)" class="dropdown-item">
                                                            Удалить
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
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
                                    <input  @change="uploadFile" type="file" class="block w-full text-sm text-gray-500
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
                                    <input v-model="this.body"
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
hidden {
    display: none !important;
}

</style>
