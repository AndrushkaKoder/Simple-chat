<script>
export default {
    name: "SearchResult",
    props: [
        'item'
    ]
}
</script>

<template>
    <div>
        <div class="font-bold text-lg">{{ item.name }}</div>
        <div class="text-xs text-gray-500">
            <span v-if="item.email" class="mr-2"><strong>Почта:</strong> {{ item.email }}</span>
            <br>
            <span v-if="item.phone" class="mr-2"><strong>Телефон:</strong> {{ item.phone }}</span>
        </div>
    </div>
</template>

<style scoped>

</style>
