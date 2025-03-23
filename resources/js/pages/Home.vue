<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home" />
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 p-6">
        <header class="flex justify-end gap-4 mb-6">
            <template v-if="$page.props.auth.user">
                <Link
                    :href="route('kanban')"
                    class="inline-block rounded-sm border border-gray-300 px-5 py-1.5 text-sm text-gray-800 hover:border-gray-400 dark:border-gray-600 dark:text-gray-200 dark:hover:border-gray-500"
                >
                    Kanban Board
                </Link>
            </template>
            <template v-else>
                <Link
                    :href="route('login')"
                    class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm text-gray-800 hover:border-gray-300 dark:text-gray-200 dark:hover:border-gray-600"
                >
                    Log in
                </Link>
                <Link
                    :href="route('register')"
                    class="inline-block rounded-sm border border-gray-300 px-5 py-1.5 text-sm text-gray-800 hover:border-gray-400 dark:border-gray-600 dark:text-gray-200 dark:hover:border-gray-500"
                >
                    Register
                </Link>
            </template>
        </header>
        <main class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">Welcome to the Kanban Board Project</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                This project is a Kanban board application where you can manage tasks visually. 
                It allows you to create, edit, delete, and reorder tasks across different statuses: 
                <strong>To Do</strong>, <strong>In Progress</strong>, and <strong>Done</strong>.
            </p>
            <p class="text-gray-600 dark:text-gray-400">
                Use the navigation links above to log in, register, or access the Kanban board if you're already logged in.
            </p>
        </main>
    </div>
</template>
