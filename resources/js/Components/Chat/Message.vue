<script>
import axios from "axios";

export default {
    name: "Message",

    props: [
        'data'
    ],
    methods: {
        hasFiles(message) {
            return message.file !== null
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
        },
    },
}
</script>

<template>
    <div v-if="!data.is_inner" class="col-start-1 col-end-8 p-3 rounded-lg">
        <div class="flex flex-row items-center">
            <div
                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                A
            </div>
            <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                <div>{{ data.body }}</div>
                <div v-if="this.hasFiles(data)">
                    <a :href="data.file" target="_blank" class="text-blue-500">Файл</a>
                </div>
                <div class="text-xs text-gray-400">{{ data.created_at }}</div>
            </div>
        </div>
    </div>

    <div v-else class="col-start-6 col-end-13 p-3 rounded-lg">
        <div class="flex items-center justify-start flex-row-reverse message_item">
            <div
                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                A
            </div>
            <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                <div>{{ data.body }}</div>
                <div v-if="this.hasFiles(data)">
                    <a :href="data.file" target="_blank" class="text-blue-500">Файл</a>
                </div>
                <div class="text-xs text-gray-400">{{ data.created_at }}</div>
                <div class="absolute text-xs bottom-0 right-0 -mb-5 mr-2 text-gray-400">
                    <span v-if="data.is_read">
                        read
                    </span>
                    <span v-else>
                        unread
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
