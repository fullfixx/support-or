<template>
    <Head title="Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create</h2>
        </template>

        <div class="mt-4">
            <div class="py-4 mb-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <form @submit.prevent="store">
                            <div class="mb-4">
                                <div>
                                    <label for="title">Title</label>
                                </div>
                                <div>
                                    <input v-model="title" class="mt-1 block w-full rounded border-gray-300" type="text" id="title" placeholder="Title (short)" v-focus />
                                </div>
                                <div>
                                    <div v-if="errors.title">{{ errors.title }}</div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div>
                                    <label for="description">Description</label>
                                </div>
                                <div>
                                    <textarea v-model="description" class="mt-1 block w-full rounded border-gray-300" rows="8" id="description" placeholder="Description"></textarea>
                                </div>
                                <div>
                                    <div v-if="errors.description">{{ errors.description }}</div>
                                </div>
                            </div>
                            <div class="mb-4 w-25">
                                <div ref="dropzone" class="bg-gray-800 text-gray-100 p-8 cursor-pointer btn">
                                    FILE
                                </div>
                            </div>
                            <div class="mb-4">
                                <div>
                                    <label for="priority">Priority</label>
                                </div>
                                <div>
                                    <select v-model="priority" class="rounded border-gray-300" id="priority" type="number">
                                        <option value="1">(1) High</option>
                                        <option value="2">(2) Medium</option>
                                        <option value="3">(3) Low</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <input @click.prevent="store" class="rounded border border-sky-300 py-2 px-8 hover:bg-sky-200 hover:border-sky-500" type="submit" value="Store">
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
                title: null,
                description: null,
                priority: 2,
                status_id: null,
                user_id: null,
                dropzone: null
            }
        },

        mounted() {
            this.dropzone = new Dropzone(this.$refs.dropzone, {
                url: "/tickets",
                autoProcessQueue: false,
            })
        },

        props: [
            'errors', 'auth'
        ],

        methods: {
            store() {
                const data = new FormData()
                const files = this.dropzone.getAcceptedFiles()
                files.forEach(file => {
                    data.append('images[]', file)
                })
                // axios.post('/tickets', {files: this.dropzone.getAcceptedFiles()})
                this.$inertia.post('/tickets', {
                    title: this.title,
                    description: this.description,
                    priority: this.priority,
                    status_id: 1,
                    user_id: this.auth.user.id,
                    files: this.dropzone.getAcceptedFiles()
                })
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

<style scoped>

</style>
