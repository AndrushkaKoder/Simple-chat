<script>
import {Link} from "@inertiajs/vue3";
import axios from "axios";
import SearchResult from "@/Components/Search/SearchResult.vue";

export default {
    name: "Search",
    components: {
        SearchResult,
        Link
    },
    data() {
        return {
            body: '',
            placeholder: 'Найти контакты',
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
                    if (this.hasResult()) {
                        this.showResultInSuccessSearch()
                    }
                })
            } else {
                this.$refs.input.classList.add('error')
            }
        },
        hasResult() {
            return Object.keys(this.searchedListData).length > 0
        },
        showResult(show = false) {
            if (this.$refs.searchedWrapper) {
                if (show) {
                    this.$refs.searchedWrapper.classList.remove('hidden');
                } else {
                    this.$refs.searchedWrapper.classList.add('hidden');
                }
            }
        },
        createOrViewChat(userId) {
            this.$inertia.post('/chat/create', {
                who: this.$page.props.auth.id,
                with: userId
            })
        },
        showResultInSuccessSearch() {
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('search_input')) {
                    this.showResult(true)
                } else if (!e.target.classList.contains('searched_list_item')) {
                    this.showResult()
                }
            })
        }
    },
}
</script>

<template>
    <div class="top-0 left-0 w-full select-none">
        <div class="relative mx-auto">
            <input
                v-model="body"
                ref="input"
                @input.prevent="search()"
                :placeholder="this.placeholder"
                required
                @focus="showResult(true)"
                type="text" id="search_input"
                class="search_input w-full h-full peer py-2.5 sm:py-3 pe-0 ps-8 block bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600"
            />
            <div ref="searchedWrapper">
                <div v-if="hasResult()"
                     class="absolute top-30 left-0 bg-white w-full min-h-44 rounded-xl shadow-xl overflow-hidden p-1"
                >
                    <div v-for="item in this.searchedListData"
                         class="w-full flex p-3 pl-4 items-center rounded-xl hover:bg-gray-300 cursor-pointer searched_list_item"
                         @click.prevent="createOrViewChat(item.id)"
                    >
                        <SearchResult :item="item"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
