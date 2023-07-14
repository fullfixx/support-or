<!--<script setup>-->
<!--import {ref, watch} from 'vue';-->
<!--import {router} from '@inertiajs/vue3';-->

<!--import {Link} from '@inertiajs/vue3';-->
<!--import {Head} from '@inertiajs/vue3';-->
<!--import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';-->


// let props = defineProps({
//     goals: Object,
//     tasks: Object,
// filters: Object,
// });
// let search = ref(props.filters.search);
// watch(search, value => {
//     router.get('/tickets', {search: value}, {
//         preserveState: true,
//         replace: true,
//     });
// });

<!--</script>-->
<template>
    <Head title="Goals"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-row justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Goals</h2>
                </div>
                <div>
                    <div class="flex flex-row gap-x-2 justify-end">
                        <button @click="toggleGoalForm"
                                class="rounded border border-gray-300 bg-green-50 hover:bg-green-100 py-1 px-4">Add goal
                        </button>
                        <button @click="toggleTaskForm"
                                class="rounded border border-gray-300 bg-green-50 hover:bg-green-100 py-1 px-4">Add task
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <div v-if="isGoalForm" class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form @submit.prevent="storeGoal">
                <div class="flex flex-col">
                    <div>
                        <div class="flex flex-row justify-center gap-x-2">
                            <input class="rounded border border-gray-300 w-3/4" v-model="goal_name" type="text"
                                   placeholder="Goal title">
                            <input class="rounded border border-gray-300 w-1/4" v-model="goal_deadline" type="date">
                        </div>
                    </div>
                    <div class="text-center pt-2">
                        <div class="flex flex-row gap-x-2">
                            <div class="w-full">
                                <textarea class="rounded border border-gray-300 w-full h-full"
                                          v-model="goal_description" type="text"
                                          placeholder="Goal description"></textarea>
                            </div>
                            <div>
                                <button
                                    class="h-20 rounded-lg border border-sky-300 bg-sky-50 px-8 hover:bg-sky-200 hover:border-sky-500"
                                    type="submit">Store
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div v-if="isTaskForm" class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form @submit.prevent="storeTask">
                <div class="flex flex-col">
                    <div>
                        <div class="flex flex-row justify-center gap-x-2">
                            <select class="rounded border border-gray-300 w-1/4" v-model="goal_id">
                                <option :value="none" :selected="true">-- Choose goal --</option>
                                <option v-for="goal in goals" :value="goal.id">{{ goal.name }}</option>
                            </select>
                            <input class="rounded border border-gray-300 w-2/4" v-model="task_name" type="text"
                                   placeholder="Task title">
                            <input class="rounded border border-gray-300 w-1/4" v-model="task_deadline" type="date">
                        </div>
                    </div>
                    <div class="text-center pt-2">
                        <div class="flex flex-row gap-x-2">
                            <div class="w-full">
                                <textarea class="rounded border border-gray-300 w-full h-full"
                                          v-model="task_description" type="text"
                                          placeholder="Task description"></textarea>
                            </div>
                            <div>
                                <button
                                    class="h-20 rounded-lg border border-sky-300 bg-sky-50 px-8 hover:bg-sky-200 hover:border-sky-500"
                                    type="submit">Store
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!--<div v-if="errors.goal_id">{{ errors.goal_id }}</div>-->
        <!--<div v-if="errors.name">{{ errors.name }}</div>-->

        <div v-if="goals.length > 0" class="mt-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 my-6 border border-gray-300">
                    <div v-for="goal in goals" :key="goal.id">
                        <div class="flex flex-row mb-20">
                            <div class="rounded-l-lg border border-gray-300 bg-amber-50 w-1/4 h-100">
                                <div class="flex flex-col">
                                    <div class="flex flex-row justify-between">
                                        <div class="font-semibold p-4 w-full">{{ goal.name }}</div>
                                        <span @click="deleteGoal(goal.id)" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </span>
                                    </div>
                                    <div class="text-gray-600 p-4 w-full h-full">{{ goal.description }}</div>
                                    <div class="text-gray-600 p-4 w-full h-full"><span
                                        class="text-gray-500 bg-amber-100 p-1 mr-2">target:</span>{{ goal.deadline }}
                                    </div>
                                    <div class="flex flex-row justify-end">
                                        <div class="text-gray-600 text-end">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="flex flex-col" v-for="task in goal.tasks">
                                    <div class="flex flex-row border border-gray-300 p-1" :class="{ 'bg-blue-50': task.status === 1, 'bg-gray-100 text-gray-500': task.status === 2, }">
                                        <div class="w-full">
                                            <div class="flex flex-row">
                                                <div class="py-4 pl-2">
                                                    <span v-if="task.status === 1" @click="changeStatus(task.id, 2)" class="cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fill-yellow-200"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" /></svg>
                                                    </span>
                                                    <span v-if="task.status === 2" @click="changeStatus(task.id, 1)" class="cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fill-green-200"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                    </span>
                                                </div>
                                                <div class="py-4 pl-2">{{ task.name }}</div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex flex-col justify-between h-full">
                                                <div class="text-end">
                                                    <div class="flex flex-row justify-end gap-x-1">
                                                        <div class="tooltip cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fill-gray-200"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/></svg>
                                                            <span class="tooltiptext">{{ task.description }}</span>
                                                        </div>
                                                        <span @click="deleteTask(task.id)" class="cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-800"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ task.deadline }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 my-6 border border-gray-300">
                    There is nothing. Add first goal and then add your tasks.
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
<script>
    import {Link} from '@inertiajs/vue3';
    import {Head} from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    export default {
        name: "Index",
        components: {
            Link, AuthenticatedLayout
        },
        props: [
            'goals', 'errors',
        ],
        data() {
            return {
                goal_name: null,
                goal_description: null,
                goal_deadline: null,
                task_name: null,
                task_description: null,
                task_deadline: null,
                isGoalForm: false,
                isTaskForm: false,
            }
        },
        methods: {
            storeGoal() {
                this.$inertia.post('/goals', {
                    name: this.goal_name,
                    description: this.goal_description,
                    deadline: this.goal_deadline,
                });
                this.goal_name = null;
                this.goal_description = null;
                this.goal_deadline = null;
            },
            storeTask() {
                this.$inertia.post('/tasks', {
                    name: this.task_name,
                    description: this.task_description,
                    deadline: this.task_deadline,
                    status: 1,
                    goal_id: this.goal_id,
                });
                this.task_name = null;
                this.task_description = null;
                this.task_deadline = null;
            },
            deleteTask(id) {
                this.$inertia.delete(`/tasks/${id}`)
            },
            deleteGoal(id) {
                this.$inertia.delete(`/goals/${id}`)
            },
            toggleGoalForm() {
                this.isTaskForm = false;
                this.isGoalForm = !this.isGoalForm;
            },
            toggleTaskForm() {
                this.isGoalForm = false;
                this.isTaskForm = !this.isTaskForm;
            },
            changeStatus(task_id, status) {
                this.$inertia.patch(`/tasks/${task_id}`, {
                    status: status,
                    preserveScroll: true,
                })
            },
        }
    }
</script>
<style scoped>
    /* Tooltip container */
    .tooltip {
        position: relative;
        display: inline-block;
        /*border-bottom: 1px dotted black; !* If you want dots under the hoverable text *!*/
    }

    /* Tooltip text */
    .tooltip .tooltiptext {
        visibility: hidden;
        width: 640px;
        background-color: white;
        color: #000;
        text-align: left;
        padding: 5px 10px;
        border-radius: 6px;
        border: 1px solid #6b7280;
        box-shadow: 3px 3px 5px gray;

        /* Position the tooltip text - see examples below! */
        position: absolute;
        z-index: 1;
        top: -5px;
        right: 105%;
    }

    /* Show the tooltip text when you mouse over the tooltip container */
    .tooltip:hover .tooltiptext {
        visibility: visible;
    }
</style>
