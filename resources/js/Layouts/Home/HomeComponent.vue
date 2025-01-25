<script>
    export default {
        data() {
            return {
                body: null
            }
        },
        props: {
            func: {
                type: String
            },
            class: {
                type: String
            }
        },
        methods: {
            sayHello() {
                console.log()
            }
        }
    }
</script>

<template>
    <h1 @click="this.sayHello">hello from {{ func }}</h1>
</template>

<style scoped>

</style>
