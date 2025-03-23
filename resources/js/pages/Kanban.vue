<script setup lang="ts">
import KanbanBoard from '../components/KanbanBoard.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Kanban Board" />
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 p-6">
        <h1 class="text-2xl font-bold text-center mb-6 text-gray-800 dark:text-gray-200">Kanban Board</h1>
        <KanbanBoard />
    </div>
</template>

