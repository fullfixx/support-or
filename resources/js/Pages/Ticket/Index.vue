<template>
    <Head title="Tickets" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tickets</h2>
        </template>

        <div v-if="tickets" class="mt-4">
            <div v-for="ticket in tickets" :key="ticket.id" class="py-2 mb-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 border border-gray-300">
                        <div class="font-semibold">{{ ticket.title }}</div>
                        <div class="flex flex-row justify-between mt-2">
                            <div>
                                status:
                                <span v-if="ticket.status_id == 1" class="text-red-600 font-bold">{{ ticket.status_name }}</span>
                                <span v-if="ticket.status_id == 2" class="text-blue-600 font-bold">{{ ticket.status_name }}</span>
                                <span v-if="ticket.status_id == 3" class="text-green-600 font-bold">{{ ticket.status_name }}</span>
                                <span v-if="ticket.status_id == 4" class="text-gray-400 font-bold">{{ ticket.status_name }}</span>
                            </div>
                            <div>priority: {{ ticket.priority }}</div>
                        </div>
                        <div class="flex flex-row justify-between">
                            <div>author: {{ ticket.user_name }}</div>
                            <div>{{ ticket.created_at }}</div>
                        </div>
                        <div class="flex flex-row mt-4 justify-end">
                            <div class="">
                                <Link class="rounded border-sky-300 bg-sky-100 border p-2 hover:border-sky-500 hover:bg-sky-200" :href="route('ticket.show', ticket.id)">Show</Link>
                            </div>
                            <div class="ml-2">
                                <Link class="rounded border-green-300 bg-green-100 border p-2 hover:border-green-500 hover:bg-green-200" :href="route('ticket.edit', ticket.id)" v-if="$page.props.auth.user.id === ticket.user_id">Edit</Link>
                            </div>
                            <div class="ml-2" v-if="$page.props.auth.user.rank === 7">
                                <p class="rounded border border-red-300 text-red-800 hover:bg-red-300 cursor-pointer px-8" @click="deleteTicket(ticket.id)">Delete</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--<Pagination :links="tickets.links" />-->
        </div>

    </AuthenticatedLayout>
</template>

<script>
    import { Link } from '@inertiajs/vue3';
    import { Head } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '@/Components/Pagination.vue'
    export default {
        name: "Index",
        components: {
            Link, AuthenticatedLayout, Pagination
        },
        props: [
            'tickets'
        ],
        methods: {
            deleteTicket(id) {
                this.$inertia.delete(`/tickets/${id}`)
            }
        }
    }
</script>

<style scoped>

</style>
