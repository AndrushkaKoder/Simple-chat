<script>
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "Search",
    components: {
        Link
    },
    data() {
        return {
            body: '',
            placeholder: 'Найди контакты',
            searchedList: {}
        }
    },
    computed: {
        searchedListData() {
            return this.searchedList
        }
    },
    methods: {
        search() {
            if (this.body.length >= 4) {
                this.$refs.input.classList.remove('error')
                axios.post('/search', {body: this.body}).then(res => {
                    this.searchedList = res.data.data
                })
            } else {
                this.$refs.input.classList.add('error')
            }
        },
        hasResult() {
            return Object.keys(this.searchedListData).length > 0
        },
        hideSearchWindow(event) {
            if (!event.target.classList.contains('list_item')) {
                this.$refs.searchedList.classList.add('hidden')
            }
        },
        createOrViewChat(userId) {
            this.$inertia.post('/chat/create', {
                who: this.$page.props.auth.id,
                with: userId
            })
        },
    },
}
</script>

<template>
    <form class="max-w-md">
        <label for="default-search"
               class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input v-model="body"
                   ref="input"
                   @input.prevent="search()"
                   type="search"
                   id="default-search"
                   class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   :placeholder="this.placeholder"
                   required
            />
        </div>
        <div v-if="hasResult()" class="searched_list" ref="searchedList" @click="hideSearchWindow">
            <div v-for="item in this.searchedListData"
                 class="flex justify-start items-center gap-6 cursor-pointer p-3 border bottom-1 rounded list_item"
                 @click.prevent="createOrViewChat(item.id)"
            >
                <div
                    class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                    A
                </div>
                <span>{{ item.name }}</span>
            </div>
        </div>
    </form>

</template>

<style scoped>
#default-search {
    cursor: pointer;
}

.error {
    border: 3px solid red;
}

.hidden {
    display: none !important;
}

.searched_list {
    background: white;
    position: absolute;
    border: 1px solid gray;
    border-radius: 10px;
    margin-top: 5px;
    min-height: 50px;
    z-index: 999;
    min-width: 350px;
}
</style>
