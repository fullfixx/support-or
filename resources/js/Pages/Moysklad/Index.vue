<script setup>
    import {ref, watch} from 'vue';
    import {router} from '@inertiajs/vue3';

    import {Link} from '@inertiajs/vue3';
    import {Head} from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


    let props = defineProps({
        moysklads: Object,
        filters: Object,
    });
    let search = ref(props.filters.search);
    watch(search, value => {
        router.get('/moysklads', {search: value}, {
            preserveState: true,
            replace: true,
        });
    });

</script>
<template>
    <Head title="МойСклад"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">МойСклад</h2>
                <div class="flex flex-row gap-2 items-center">
                    <div></div>
                    <div><input class="rounded-lg border border-gray-500" v-model="search" type="text" placeholder="Search.."/></div>
                </div>
            </div>
        </template>

        <div v-if="moysklads.data.length > 0" class="mt-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 my-6 border border-gray-300">
                    <table class="border-collapse border border-slate-400 font-medium text-gray-500">
                        <thead>
                        <tr class="bg-gray-800 text-gray-100 h-12">
                            <th class="border border-slate-300 px-2 w-1/6">MSID</th>
                            <th class="border border-slate-300 px-2">Title</th>
                            <th class="border border-slate-300 px-2">Code</th>
                            <th class="border border-slate-300 px-2">stock</th>
                            <th class="border border-slate-300 px-2">reserve</th>
                            <th class="border border-slate-300 px-2">inTransit</th>
                            <th class="border border-slate-300 px-2">quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="moysklad in moysklads.data" :key="moysklad.id" class="hover:bg-gray-100 h-12">
                            <th class="border border-slate-300 px-2">{{ moysklad.id }}</th>
                            <th class="border border-slate-300 px-2 text-start">{{ moysklad.name }}</th>
                            <th class="border border-slate-300 px-2 text-start">{{ moysklad.code }}</th>
                            <th class="border border-slate-300 px-2">{{ moysklad.stock }}</th>
                            <th class="border border-slate-300 px-2">{{ moysklad.reserve }}</th>
                            <th class="border border-slate-300 px-2">{{ moysklad.inTransit }}</th>
                            <th class="border border-slate-300 px-2">{{ moysklad.quantity }}</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--Paginator-->
        <div v-if="moysklads.meta.links.length > 3" class="flex flex-row gap-1 justify-center mt-4 mb-8 pb-8">
            <Link v-for="link in moysklads.meta.links"
                  :href="link.url"
                  :disabled="link.url === null"
                  :class="{
                  'bg-green-200': link.active,
                  'bg-gray-200 hover:bg-gray-200 text-gray-500 cursor-default': link.url === null,
                  'bg-white hover:bg-sky-200': link.url !== null
                  }"
                  v-html="link.label"
                  class="border border-gray-300 py-2 px-4 rounded"/>
        </div>
    </AuthenticatedLayout>
</template>
