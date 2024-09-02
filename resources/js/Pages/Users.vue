<template>
    <div class="h-screen w-full flex justify-center items-center">
        <div v-if="loading">Loading users...</div>
        <div v-else-if="error">Error: {{ error }}</div>
        <div v-else-if="users">
            Number of users: {{ users.length }}
        </div>
        <div v-else>No users data available</div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'

const users = ref(null)
const loading = ref(true)
const error = ref(null)

onMounted(async () => {
    try {
        users.value = await usePage().props.users
    } catch (e) {
        error.value = e.message
    } finally {
        loading.value = false
    }
})
</script>
