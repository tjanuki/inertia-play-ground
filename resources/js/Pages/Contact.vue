<script setup>
import { ref, computed } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'

const form = useForm({
    name: 'test',
    email: 'example@example.com',
    message: 'Hello world'
})

const page = usePage()

const submit = () => {
    form.post(route('contact.submit'), {
        preserveScroll: true,
        onSuccess: () => form.reset()
    })
}

const flashMessage = computed(() => {
    const flash = page.props.flash || {}
    return flash.message || flash.status || form.errors.message
})
</script>

<template>
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Contact Us</h1>

        <!-- Session Message Component -->
        <div v-if="flashMessage"
             class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ flashMessage }}</span>
        </div>

        <form @submit.prevent="submit">
            <div class="mb-4">
                <label for="name" class="block mb-2">Name</label>
                <input id="name" v-model="form.name" type="text" class="w-full p-2 border rounded" required>
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2">Email</label>
                <input id="email" v-model="form.email" type="email" class="w-full p-2 border rounded" required>
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
            </div>
            <div class="mb-4">
                <label for="message" class="block mb-2">Message</label>
                <textarea id="message" v-model="form.message" class="w-full p-2 border rounded" rows="4"
                          required></textarea>
                <div v-if="form.errors.message" class="text-red-500 text-sm mt-1">{{ form.errors.message }}</div>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" :disabled="form.processing">
                Send Message
            </button>
        </form>
    </div>
</template>
