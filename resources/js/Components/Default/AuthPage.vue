<script>
export default {
    name: "AuthPage"
}
</script>

<template>
    <div
        class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-blue-800 to-purple-700 i justify-around items-center hidden">
        <div class="flex items-center justify-center flex-col">
            <h1 class="text-white font-bold text-4xl font-sans">{{ $page.props.appName }}</h1>
            <p class="text-white mt-1">Чат на Laravel + InertiaJs + Vue3</p>
            <a href="https://github.com/AndrushkaKoder/Simple-chat" target="_blank" class="text-center block w-40 bg-white text-indigo-800 mt-4 py-2 rounded-2xl font-bold mb-2">
                GitHub
            </a>
        </div>
        <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
    </div>
</template>

<style scoped>

</style>
