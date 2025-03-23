<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Container, Draggable } from 'vue3-smooth-dnd';
import TaskModal from './TaskModal.vue';


interface Task {
    id: number;
    title: string;
    description?: string;
    status: string; 
    order: number;
}

const tasks = ref<Task[]>([]);
const isModalOpen = ref(false);
const isEditMode = ref(false);
const currentTaskTitle = ref('');
const currentTaskDescription = ref('');
const currentTaskId = ref<number | null>(null);
const currentTaskStatus = ref('');

const fetchTasks = async (): Promise<void> => {
    const response = await axios.get<Task[]>('/api/tasks');
    tasks.value = response.data;
};

const addTask = async (status: string): Promise<void> => {
    currentTaskStatus.value = status;
    currentTaskTitle.value = '';
    currentTaskDescription.value = '';
    currentTaskId.value = null;
    isEditMode.value = false;
    isModalOpen.value = true;
};

const editTask = (task: Task): void => {
    currentTaskStatus.value = task.status;
    currentTaskTitle.value = task.title;
    currentTaskDescription.value = task.description || '';
    currentTaskId.value = task.id;
    isEditMode.value = true;
    isModalOpen.value = true;
};

const saveTask = async (title: string, description: string, status: string): Promise<void> => {
    if (isEditMode.value && currentTaskId.value !== null) {
        
        await axios.put(`/api/tasks/${currentTaskId.value}`, { title, description, status });
        const task = tasks.value.find((t) => t.id === currentTaskId.value);
        if (task) {
            task.title = title;
            task.description = description;
            task.status = status;
        }
    } else {
        
        const response = await axios.post<Task>('/api/tasks', {
            title,
            description,
            status,
        });
        tasks.value.push(response.data);
    }
};

const deleteTask = async (id: number): Promise<void> => {
    await axios.delete(`/api/tasks/${id}`);
    tasks.value = tasks.value.filter((task) => task.id !== id);
};

const updateTaskOrder = async (status: string, newOrder: Task[]): Promise<void> => {
    const reorderedTasks = newOrder.map((task, index) => ({
        id: task.id,
        order: index,
        status, 
    }));

    await axios.post('/api/tasks/reorder', { tasks: reorderedTasks });

    
    tasks.value = tasks.value.map((task) => {
        const updatedTask = reorderedTasks.find((t) => t.id === task.id);
        return updatedTask ? { ...task, order: updatedTask.order, status: updatedTask.status } : task;
    });
};

const handleDrop = (status: string, dropResult: any) => {
    const columnTasks = tasks.value.filter((task) => task.status === status);
    const reorderedTasks = applyDrag(columnTasks, dropResult);

    
    if (dropResult.payload) {
        const draggedTask = tasks.value.find((task) => task.id === dropResult.payload.id);
        if (draggedTask) {
            draggedTask.status = status; 
        }
    }

    
    updateTaskOrder(status, reorderedTasks);
};


const applyDrag = (arr: Task[], dragResult: any): Task[] => {
    const { removedIndex, addedIndex, payload } = dragResult;
    if (removedIndex === null && addedIndex === null) return arr;

    const result = [...arr];
    let itemToAdd = payload;

    if (removedIndex !== null) {
        itemToAdd = result.splice(removedIndex, 1)[0];
    }

    if (addedIndex !== null) {
        result.splice(addedIndex, 0, itemToAdd);
    }

    return result;
};

onMounted(fetchTasks);
</script>

<template>
    <div class="flex gap-4 p-4 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div
            v-for="status in ['To Do', 'In Progress', 'Done']"
            :key="status"
            class="flex flex-col gap-4 bg-gray-200 dark:bg-gray-800 rounded-lg p-4 shadow-md w-1/3"
        >
            <!-- Title and Add Button -->
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">{{ status }}</h3>
                <button
                    class="text-blue-500 dark:text-blue-400 text-sm hover:underline"
                    @click="addTask(status)"
                >
                    + Add a card...
                </button>
            </div>

            <!-- Task Container -->
            <Container
                :group-name="'tasks'"
                :get-child-payload="(index) => tasks.filter((task) => task.status === status)[index]"
                @drop="handleDrop(status, $event)"
                class="flex flex-col gap-2"
            >
                <Draggable
                    v-for="task in tasks.filter((task) => task.status === status)"
                    :key="task.id"
                >
                    <div class="flex justify-between items-center bg-white dark:bg-gray-700 rounded-md p-3 shadow-sm">
                        <p class="text-sm text-gray-800 dark:text-gray-200">{{ task.title }}</p>
                        <div class="flex gap-2">
                            <button
                                class="text-blue-500 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300"
                                @click="editTask(task)"
                            >
                                ✏️
                            </button>
                            <button
                                class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300"
                                @click="deleteTask(task.id)"
                            >
                                🗑️
                            </button>
                        </div>
                    </div>
                </Draggable>
            </Container>
        </div>
    </div>

    <!-- Task Modal -->
    <TaskModal
        :isOpen="isModalOpen"
        :isEdit="isEditMode"
        :initialTaskTitle="currentTaskTitle"
        :initialTaskDescription="currentTaskDescription"
        :initialTaskStatus="currentTaskStatus"
        @close="isModalOpen = false"
        @save="saveTask"
    />
</template>