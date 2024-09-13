<script setup>
import { ref, computed, watch } from 'vue'
import { useForm, usePage, useRemember, Link } from '@inertiajs/vue3'

const rememberedFormData = useRemember({
    name: '',
    email: '',
    message: ''
}, 'contact-form')

const form = useForm({
    name: rememberedFormData.name,
    email: rememberedFormData.email,
    message: rememberedFormData.message
})

// Watch for changes in the form and update rememberedFormData
watch(form, (newValue) => {
    rememberedFormData.name = newValue.name
    rememberedFormData.email = newValue.email
    rememberedFormData.message = newValue.message
    console.log('Form updated:', newValue)
}, { deep: true })

const page = usePage()

const preferences = useRemember({
    theme: 'light',
}, 'user-preferences')

const submit = () => {
    form.post(route('contact.submit'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            rememberedFormData.name = ''
            rememberedFormData.email = ''
            rememberedFormData.message = ''
        }
    })
}

const flashMessage = computed(() => {
    const flash = page.props.flash || {}
    return flash.message || flash.status || form.errors.message
})

const toggleTheme = () => {
    preferences.theme = preferences.theme === 'light' ? 'dark' : 'light'
    console.log('Theme toggled:', preferences.theme)
}

// Debug log
console.log('Contact: Remembered form data:', rememberedFormData)
console.log('Contact: Preferences:', preferences)
</script>

<template>
    <div class="max-w-2xl mx-auto p-4" :class="{ 'dark': preferences.theme === 'dark' }">
        <h1 class="text-2xl font-bold mb-4">Contact Us</h1>

        <button @click="toggleTheme" class="mb-4 px-4 py-2 bg-gray-200 rounded">
            Toggle Theme (Current: {{ preferences.theme }})
        </button>

        <!-- Rest of the template remains the same -->

        <div class="mt-4">
            <h2 class="text-xl font-semibold mb-2">Debug Info:</h2>
            <pre>{{ JSON.stringify({ form: form, rememberedFormData, preferences }, null, 2) }}</pre>
        </div>
    </div>
</template>
