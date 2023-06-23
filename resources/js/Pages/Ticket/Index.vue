<script setup>
    import {ref, watch} from 'vue';
    import {router} from '@inertiajs/vue3';

    import {Link} from '@inertiajs/vue3';
    import {Head} from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


    let props = defineProps({
        tickets: Object,
        filters: Object,
    });
    let search = ref(props.filters.search);
    watch(search, value => {
        router.get('/tickets', {search: value}, {
            preserveState: true,
            replace: true,
        });
    });

</script>
<template>
    <Head title="Tickets"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tickets</h2>
                <div class="flex flex-row gap-2 items-center">
                    <a :href="route('ticket.index')" ><div class="flex-none w-20 border border-gray-500 text-center py-2 rounded-lg bg-gray-1000 hover:bg-gray-700 hover:text-white">all</div></a>
                    <a :href="route('ticket.index.group', 1)" ><div class="flex-none w-20 border border-gray-300 text-center py-2 rounded-lg bg-red-100 hover:bg-gray-700 hover:text-white">new</div></a>
                    <a :href="route('ticket.index.group', 2)" ><div class="flex-none w-20 border border-gray-300 text-center py-2 rounded-lg bg-blue-100 hover:bg-gray-700 hover:text-white">working</div></a>
                    <a :href="route('ticket.index.group', 3)" ><div class="flex-none w-20 border border-gray-300 text-center py-2 rounded-lg bg-green-200 hover:bg-gray-700 hover:text-white">done</div></a>
                    <a :href="route('ticket.index.group', 4)" ><div class="flex-none w-20 border border-gray-300 text-center py-2 rounded-lg bg-gray-200 hover:bg-gray-700 hover:text-white">closed</div></a>
                    <div ><input class="rounded-lg border border-gray-500" v-model="search" type="text" placeholder="Search.."/></div>
                </div>
            </div>
        </template>

        <div v-if="tickets" class="mt-8">
            <div v-for="ticket in tickets.data" :key="ticket.id">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <Link :href="route('ticket.show', ticket.id)">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 my-6 border border-gray-300">
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
                        </div>
                    </Link>
                </div>
            </div>
        </div>

        <!--Paginator-->
        <div v-if="tickets.meta.links.length > 3" class="flex flex-row gap-1 justify-center mt-4 mb-8 pb-8">
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
<!--<script>-->
    <!--import {Link} from '@inertiajs/vue3';-->
    <!--import {Head} from '@inertiajs/vue3';-->
    <!--import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';-->

    <!--export default {-->
        <!--name: "Index",-->
        <!--components: {-->
            <!--Link, AuthenticatedLayout-->
        <!--},-->
        <!--props: [-->
            <!--'tickets'-->
        <!--],-->
        <!--methods: {-->
            <!--deleteTicket(id) {-->
                <!--this.$inertia.delete(`/tickets/${id}`)-->
            <!--},-->
        <!--}-->
    <!--}-->
<!--</script>-->

