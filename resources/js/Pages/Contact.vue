<template>
    <form @submit.prevent="submitForm">
        <div>
            <label for="first_name">First Name:</label>
            <input id="first_name" v-model="form.first_name" type="text" />
        </div>
        <div>
            <label for="last_name">Last Name:</label>
            <input id="last_name" v-model="form.last_name" type="text" />
        </div>
        <button type="submit">Submit</button>
    </form>
</template>

<script setup>
import { useRemember } from '@inertiajs/vue3'

const form = useRemember({
    first_name: null,
    last_name: null,
})

const submitForm = () => {
    // Here you would typically submit the form data
    console.log('Form submitted:', form)
}
</script>
