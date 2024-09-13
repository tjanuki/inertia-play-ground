<script setup>
import { useRemember } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

const rememberedFormData = useRemember({
    name: '',
    email: '',
    message: ''
}, 'contact-form')

const preferences = useRemember({
    theme: 'light',
}, 'user-preferences')

const toggleTheme = () => {
    preferences.theme = preferences.theme === 'light' ? 'dark' : 'light'
    console.log('Theme toggled:', preferences.theme)
}

const clearRememberedData = () => {
    rememberedFormData.name = ''
    rememberedFormData.email = ''
    rememberedFormData.message = ''
    console.log('Remembered data cleared')
}

// Debug log
console.log('ContactRemembered: Remembered form data:', rememberedFormData)
console.log('ContactRemembered: Preferences:', preferences)
</script>

<template>
    <div class="max-w-2xl mx-auto p-4" :class="{ 'dark': preferences.theme === 'dark' }">
        <h1 class="text-2xl font-bold mb-4">Remembered Data Page</h1>

        <button @click="toggleTheme" class="mb-4 px-4 py-2 bg-gray-200 rounded">
            Toggle Theme (Current: {{ preferences.theme }})
        </button>

        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Remembered Form Data:</h2>
            <p><strong>Name:</strong> {{ rememberedFormData.name }}</p>
            <p><strong>Email:</strong> {{ rememberedFormData.email }}</p>
            <p><strong>Message:</strong> {{ rememberedFormData.message }}</p>
        </div>

        <button @click="clearRememberedData" class="mb-4 px-4 py-2 bg-red-500 text-white rounded">
            Clear Remembered Data
        </button>

        <div>
            <Link href="/contact" class="text-blue-500 underline">
                Go back to Contact Form
            </Link>
        </div>

        <div class="mt-4">
            <h2 class="text-xl font-semibold mb-2">Debug Info:</h2>
            <pre>{{ JSON.stringify({ rememberedFormData, preferences }, null, 2) }}</pre>
        </div>
    </div>
</template>
