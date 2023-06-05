<template>
    <Head title="Add new files" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add new files for Ticket #{{ ticket.id }}</h2>
        </template>

        <div class="mt-4">
            <div class="py-4 mb-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <form @submit.prevent="store">
                            <div class="mb-4 w-25">
                                <div ref="dropzone" class="bg-gray-800 text-gray-100 p-8 cursor-pointer btn">
                                    FILE
                                </div>
                            </div>
                            <div>
                                <input class="rounded border border-sky-300 py-2 px-8 hover:bg-sky-200 hover:border-sky-500" type="submit" value="Store">
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
    import Dropzone from 'dropzone';

    export default {
        name: "Create",
        components: {
            Link, AuthenticatedLayout
        },

        data() {
            return {
                ticket_id: null,
                dropzone: null,
            }
        },

        mounted() {
            this.dropzone = new Dropzone(this.$refs.dropzone, {
                url: "/files",
                autoProcessQueue: false,
            })
        },

        props: [
            'errors', 'auth', 'ticket'
        ],

        methods: {
            store() {
                const data = new FormData();
                const files = this.dropzone.getAcceptedFiles();
                files.forEach(file => {
                    data.append('images[]', file)
                });
                this.$inertia.post('/files', {
                    ticket_id: this.ticket.id,
                    files: this.dropzone.getAcceptedFiles()
                })
            }
        },
    }
</script>
