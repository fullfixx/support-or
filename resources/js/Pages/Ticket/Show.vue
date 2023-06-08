<template>
    <Head title="Ticket#" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ticket #{{ ticket.id }}</h2>
        </template>

        <div v-if="ticket" class="mt-4">
            <div class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <div class="flex flex-row justify-between">
                            <div class="text-lg font-bold">{{ ticket.title }}</div>
                            <div>priority: {{ ticket.priority }}</div>
                        </div>
                        <div class="mt-3 block w-full rounded border border-dashed border-gray-300 bg-stone-50 whitespace-pre-wrap p-4">{{ ticket.description }}</div>
                        <div class="mt-4 text-end"><span class="text-sm font-light text-gray-400 mr-4">deadline:</span> {{ ticket.deadline_carbon }}</div>
                        <div class="flex flex-row justify-between mt-0">
                            <div>
                                status:
                                <span v-if="ticket.status_id == 1" class="text-red-600 font-bold">{{ ticket.status_name }}</span>
                                <span v-if="ticket.status_id == 2" class="text-blue-600 font-bold">{{ ticket.status_name }}</span>
                                <span v-if="ticket.status_id == 3" class="text-green-600 font-bold">{{ ticket.status_name }}</span>
                                <span v-if="ticket.status_id == 4" class="text-gray-400 font-bold">{{ ticket.status_name }}</span>
                            </div>
                            <div><span class="text-sm font-light text-gray-400 mr-4">created at:</span>{{ ticket.created_at }}</div>
                        </div>
                        <div class="flex flex-row justify-between">
                            <div>author: {{ ticket.user_name }}</div>
                            <div><span class="text-sm font-light text-gray-400 mr-4">updated at:</span>{{ ticket.updated_at }}</div>
                        </div>
                        <div class="mt-3">
                            <span class="text-medium text-gray-500">Available Actions:</span>
                        </div>
                        <div class="flex flex-row mt-3 justify-between">
                            <div class="flex flex-row justify-start gap-x-2">
                                <div v-if="$page.props.auth.user.rank === 7">
                                    <Link class="rounded border-sky-300 bg-sky-100 border p-2 hover:border-sky-500 hover:bg-sky-200" :href="route('ticket.working', ticket.id)">Working</Link>
                                </div>
                                <div v-if="$page.props.auth.user.rank === 7">
                                    <Link class="rounded border-green-300 bg-green-100 border p-2 hover:border-green-500 hover:bg-green-200" :href="route('ticket.done', ticket.id)">Done</Link>
                                </div>
                                <div v-if="$page.props.auth.user.id === ticket.user_id">
                                    <Link class="rounded border-gray-300 bg-gray-100 border p-2 hover:border-gray-500 hover:bg-gray-200" :href="route('ticket.closed', ticket.id)">Closed</Link>
                                </div>
                            </div>

                            <div class="flex flex-row justify-end gap-x-2">
                                <div>
                                    <Link
                                        class="rounded border-green-300 bg-green-100 border p-2 hover:border-green-500 hover:bg-green-200"
                                        :href="route('file.create', ticket.id)">
                                    Add a file</Link>
                                </div>
                                <div>
                                    <Link
                                        class="rounded border-green-300 bg-green-100 border p-2 hover:border-green-500 hover:bg-green-200"
                                        :href="route('ticket.edit', ticket.id)"
                                        v-if="$page.props.auth.user.id === ticket.user_id">
                                    Edit</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="-mt-2">
            <div class="py-0">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                        <div class="flex flex-row justify-end">
                            <div v-for="file in files" :key="file.id">
                                <div class="">
                                    <img :src="file.path" class="hover:h-full h-16 aspect-video object-cover p-1 rounded-lg cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-4">
            <h3 class="font-semibold text-gray-800">Comments:</h3>
        </div>

        <div class="mt-0">
            <div class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <form @submit.prevent="store">
                            <div class="flex flex-row gap-x-2 justify-start">
                                <div class="flex-initial w-80">
                                    <textarea v-model="content" class="block w-full rounded border-gray-300" id="title" rows="2" placeholder="leave your comment here..."></textarea>
                                </div>
                                <div>
                                    <button class="h-full rounded border border-sky-300 bg-sky-50 py-2 px-8 hover:bg-sky-200 hover:border-sky-500" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="comments" class="pb-20">
            <div v-for="comment in comments">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3 p-4">
                        <div class="flex flex-row gap-4 h-full">
                            <div v-if="comment.user_id === 1" class="border border-white border-r-4 border-r-red-300">
                                <div class="shrink-0 w-32">{{ comment.user_name }}</div>
                                <div class="mt-2 text-sm text-gray-400">{{ comment.created_at }}</div>
                            </div>
                            <div v-if="comment.user_id === 2" class="border border-white border-r-4 border-r-blue-300">
                                <div class="shrink-0 w-32">{{ comment.user_name }}</div>
                                <div class="mt-2 text-sm text-gray-400">{{ comment.created_at }}</div>
                            </div>
                            <div v-if="comment.user_id === 3" class="border border-white border-r-4 border-r-purple-300">
                                <div class="shrink-0 w-32">{{ comment.user_name }}</div>
                                <div class="mt-2 text-sm text-gray-400">{{ comment.created_at }}</div>
                            </div>
                            <div v-if="comment.user_id === 4" class="border border-white border-r-4 border-r-green-300">
                                <div class="shrink-0 w-32">{{ comment.user_name }}</div>
                                <div class="mt-2 text-sm text-gray-400">{{ comment.created_at }}</div>
                            </div>
                            <div class="grow whitespace-pre-wrap">{{ comment.content }}</div>
                        </div>
                        <div class="flex flex-row justify-end">
                        </div>
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
        name: "Index",
        components: {
            Link, AuthenticatedLayout
        },
        data() {
            return {
                user_id: null,
                ticket_id: null,
                content: null,
            }
        },
        props: [
            'ticket','comments', 'auth', 'files'
        ],
        methods: {
            store() {
                this.$inertia.post('/comments', {
                    user_id: this.auth.user.id,
                    ticket_id: this.ticket.id,
                    content: this.content
                });
                this.content = null;
            }
        },
    }
</script>

<style scoped>

</style>
