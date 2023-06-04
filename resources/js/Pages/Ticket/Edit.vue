<template>
    <Head title="Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit</h2>
        </template>

        <div class="mt-4">
            <div class="py-4 mb-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <form @keyup.ctrl.enter.exact="update">
                            <div class="mb-4">
                                <div>
                                    <label for="title">Title</label>
                                </div>
                                <div>
                                    <input v-model="title" class="mt-3 block w-full rounded border border-gray-300 bg-stone-50" type="text" id="title" placeholder="Title" v-focus />
                                </div>
                            </div>
                            <div class="mb-4">
                                <div>
                                    <label for="description">Description</label>
                                </div>
                                <div>
                                    <textarea v-model="description" class="mt-3 block w-full rounded border border-gray-300 bg-stone-50" rows="8" id="description" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div>
                                    <label for="deadline">Deadline:</label>
                                </div>
                                <div>
                                    <input :value="ticket.deadline_carbon" :class="isEditing(ticket.id) ? 'hidden' : 'mt-1 w-1/6 bg-gray-200 border-gray-400 rounded'" type="text" disabled>
                                    <input v-model="deadline" :class="isEditing(ticket.id) ? 'mt-1 w-1/6' : 'hidden'" type="date" id="deadline">
                                    <a @click.prevent="editItemById(ticket.id)" :class="isEditing(ticket.id) ? 'hidden' : 'mt-1 p-3 w-24 bg-sky-100 border border-gray-100 text-gray-800 hover:bg-sky-300 border-gray-400 rounded text-center cursor-pointer'">Change</a>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div>
                                    <label for="priority">Priority</label>
                                </div>
                                <select v-model="priority" class="rounded border-gray-300" id="priority" type="number">
                                    <option value="1">(1) High</option>
                                    <option value="2">(2) Medium</option>
                                    <option value="3">(3) Low</option>
                                </select>
                            </div>
                            <div class="flex flex-row justify-between">
                                <button class="rounded border border-sky-300 bg-sky-100 px-8 hover:border-sky-500 hover:bg-sky-200" type="submit">Update</button>
                                <Link :href="route('ticket.show', ticket.id)" class="rounded border border-red-300 bg-red-100 h-full px-8 py-2 hover:border-sky-500 hover:bg-sky-200">Cancel</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>
    import { Link } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    export default {
        name: "Create",
        components: {
            Link, AuthenticatedLayout
        },

        data() {
            return {
                id: this.ticket.id,
                title: this.ticket.title,
                description: this.ticket.description,
                priority: this.ticket.priority,
                user_id: this.ticket.user_id,
                deadline: this.ticket.deadline_raw,
                itemId: null
            }
        },

        props: [
            'ticket'
        ],

        methods: {
            update() {
                this.$inertia.patch(`/tickets/${this.id}`, {
                    title: this.title,
                    description: this.description,
                    priority: this.priority,
                    user_id: this.user_id,
                    deadline: this.deadline,
                })
            },

            editItemById(id) {
                this.itemId = id
            },

            isEditing(id) {
                return this.itemId === id
            }

        },

        directives: {
            focus: {
                // определение директивы
                mounted(el) {
                    el.focus()
                }
            }
        }
    }
</script>
