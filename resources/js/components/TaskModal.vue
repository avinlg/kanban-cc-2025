<template>
    <div
        v-if="isOpen"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200">
                {{ isEdit ? 'Edit Task' : 'Create Task' }}
            </h2>
            <form @submit.prevent="handleSubmit">
                <!-- Task Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task Title</label>
                    <input
                        id="title"
                        v-model="taskTitle"
                        type="text"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                        placeholder="Enter task title"
                        required
                    />
                </div>

                <!-- Task Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task Description</label>
                    <textarea
                        id="description"
                        v-model="taskDescription"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                        placeholder="Enter task description"
                        rows="4"
                    ></textarea>
                </div>

                <!-- Task Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task Status</label>
                    <select
                        id="status"
                        v-model="taskStatus"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                        required
                    >
                        <option value="To Do">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2">
                    <button
                        type="button"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded hover:bg-gray-400 dark:hover:bg-gray-500"
                        @click="closeModal"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                    >
                        {{ isEdit ? 'Save Changes' : 'Create Task' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';


const props = defineProps<{
    isOpen: boolean; 
    isEdit: boolean; 
    initialTaskTitle: string; 
    initialTaskDescription?: string; 
    initialTaskStatus: string; 
}>();


const emit = defineEmits<{
    (e: 'close'): void; 
    (e: 'save', taskTitle: string, taskDescription: string, taskStatus: string): void; 
}>();

const taskTitle = ref('');
const taskDescription = ref('');
const taskStatus = ref('To Do');


watch(
    () => props.initialTaskTitle,
    (newTitle) => {
        taskTitle.value = newTitle || '';
    },
    { immediate: true }
);

watch(
    () => props.initialTaskDescription,
    (newDescription) => {
        taskDescription.value = newDescription || '';
    },
    { immediate: true }
);

watch(
    () => props.initialTaskStatus,
    (newStatus) => {
        taskStatus.value = newStatus || 'To Do';
    },
    { immediate: true }
);


const closeModal = () => {
    taskTitle.value = '';
    taskDescription.value = '';
    taskStatus.value = 'To Do';
    emit('close');
};


const handleSubmit = () => {
    emit('save', taskTitle.value, taskDescription.value, taskStatus.value);
    closeModal();
};
</script>