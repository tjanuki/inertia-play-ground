<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Users and Companies</h1>

        <!-- Users list -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Users ({{ users.data.length }})</h2>
            <ul class="space-y-2">
                <li v-for="user in users.data" :key="user.id" class="bg-gray-100 p-2 rounded">
                    {{ user.name }}
                </li>
            </ul>

            <!-- Pagination -->
            <div class="mt-4 flex justify-between items-center">
                <template v-for="link in users.links" :key="link.url">
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        class="px-4 py-2 border rounded"
                        :class="{ 'bg-blue-500 text-white': link.active }"
                        :preserve-scroll="true"
                        :only="['users']"
                        v-html="link.label"
                    ></Link>
                    <span
                        v-else
                        class="px-4 py-2 border rounded text-gray-400"
                        v-html="link.label"
                    ></span>
                </template>
            </div>
        </div>

        <!-- Companies list -->
        <div>
            <h2 class="text-xl font-semibold mb-2">Companies ({{ companies.length }})</h2>
            <ul class="space-y-2">
                <li v-for="company in companies" :key="company.id" class="bg-gray-100 p-2 rounded">
                    {{ company.name }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { usePage, Link } from '@inertiajs/vue3'

const page = usePage()

// Use computed properties to reactively access page props
const users = computed(() => page.props.users)
const companies = computed(() => page.props.companies)
</script>
