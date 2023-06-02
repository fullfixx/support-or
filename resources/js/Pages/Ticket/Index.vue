<template>
    <Head title="Tickets"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tickets</h2>
        </template>

        <div v-if="tickets" class="mt-4">
            <div v-for="ticket in tickets.data" :key="ticket.id" class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 border border-gray-300">
                        <div class="flex flex-row justify-between">
                            <div class="font-semibold">{{ ticket.title }}</div>
                            <div>priority: {{ ticket.priority }}</div>
                        </div>
                        <div class="flex flex-row justify-between mt-2">
                            <div>
                                status:
                                <span v-if="ticket.status_id == 1" class="text-red-600 font-bold">{{ ticket.status_name }}</span>
                                <span v-if="ticket.status_id == 2" class="text-blue-600 font-bold">{{ ticket.status_name }}</span>
                                <span v-if="ticket.status_id == 3" class="text-green-600 font-bold">{{ ticket.status_name }}</span>
                                <span v-if="ticket.status_id == 4" class="text-gray-400 font-bold">{{ ticket.status_name }}</span>
                            </div>

                        </div>
                        <div class="flex flex-row justify-between">
                            <div>author: {{ ticket.user_name }}</div>
                            <div>{{ ticket.created_at }}</div>
                        </div>
                        <div class="flex flex-row mt-4 justify-end">
                            <div class="">
                                <Link
                                    class="rounded border-sky-300 bg-sky-100 border p-2 hover:border-sky-500 hover:bg-sky-200"
                                    :href="route('ticket.show', ticket.id)">
                                Show</Link>
                            </div>
                            <div class="ml-2">
                                <Link
                                    class="rounded border-green-300 bg-green-100 border p-2 hover:border-green-500 hover:bg-green-200"
                                    :href="route('ticket.edit', ticket.id)"
                                    v-if="$page.props.auth.user.id === ticket.user_id">
                                Edit</Link>
                            </div>
                            <div class="ml-2" v-if="$page.props.auth.user.rank === 7">
                                <p class="rounded border border-red-300 text-red-800 hover:bg-red-300 cursor-pointer px-8"
                                   @click="deleteTicket(ticket.id)">Delete</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row gap-1 justify-center mt-4 mb-10">
            <Link v-for="link in tickets.meta.links"
                  :href="link.url"
                  :disabled="link.url === null"
                  :class="{
                  'bg-green-200': link.active,
                  'bg-gray-200 hover:bg-gray-200 text-gray-500 cursor-default': link.url === null,
                  'bg-white hover:bg-sky-200': link.url !== null
                  }"
                  v-html="link.label"
                  preserve-scroll
                  class="border border-gray-300 py-2 px-4 rounded"/>
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
