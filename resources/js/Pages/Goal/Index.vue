<script setup>
    import {ref, watch} from 'vue';
    import {router} from '@inertiajs/vue3';

    import {Link} from '@inertiajs/vue3';
    import {Head} from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


    let props = defineProps({
        goals: Object,
        tasks: Object,
        // filters: Object,
    });
    // let search = ref(props.filters.search);
    // watch(search, value => {
    //     router.get('/tickets', {search: value}, {
    //         preserveState: true,
    //         replace: true,
    //     });
    // });

</script>
<template>
    <Head title="Goals"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Goals</h2>
            </div>
        </template>

        <div v-if="goals" class="mt-8">
            <div v-for="goal in goals" :key="goal.id">


                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 my-6 border border-gray-300">
                            <div class="">
                                <div class="border border-gray-300 bg-rose-100 font-semibold">{{ goal.name }}</div>
                                <template v-for="task in goal.tasks">
                                    <div class="border border-gray-300 bg-sky-100 font-semibold">{{ task.name }}</div>
                                </template>
                            </div>
                        </div>
                    </div>


            </div>
        </div>

        <!--Paginator-->
        <!--<div v-if="tickets.meta.links.length > 3" class="flex flex-row gap-1 justify-center mt-4 mb-8 pb-8">-->
            <!--<Link v-for="link in tickets.meta.links"-->
                  <!--:href="link.url"-->
                  <!--:disabled="link.url === null"-->
                  <!--:class="{-->
                  <!--'bg-green-200': link.active,-->
                  <!--'bg-gray-200 hover:bg-gray-200 text-gray-500 cursor-default': link.url === null,-->
                  <!--'bg-white hover:bg-sky-200': link.url !== null-->
                  <!--}"-->
                  <!--v-html="link.label"-->
                  <!--preserve-scroll-->
                  <!--class="border border-gray-300 py-2 px-4 rounded"/>-->
        <!--</div>-->
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

