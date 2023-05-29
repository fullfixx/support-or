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
                        <form @submit.prevent="update">
                            <div class="mb-4">
                                <div>
                                    <label for="title">Title</label>
                                </div>
                                <div>
                                    <input v-model="title" class="mt-1 block w-full" type="text" id="title" placeholder="Title">
                                </div>
                            </div>
                            <div class="mb-4">
                                <div>
                                    <label for="description">Description</label>
                                </div>
                                <div>
                                    <textarea v-model="description" class="mt-1 block w-full" rows="8" id="description" placeholder="Description"></textarea>
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
                            <div>
                                <button class="rounded border border-sky-300 py-2 px-8 hover:border-sky-500 hover:bg-sky-200" type="submit">Update</button>
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
                })
            }
        }
    }
</script>

<style scoped>

</style>
