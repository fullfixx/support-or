<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template><Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-extrabold">Patch 29.06.2023 notes</h3>
                        <ul class="mt-4 pl-6 list-disc">
                            <li>добавлена функция оповещений о новых комментариях внутри тикетов через Telegram. Для начала использования нужно найти контакт <span class="font-mono text-red-600">@OnerideBot</span> и написать ему в чат <span class="font-mono text-red-600">/start</span></li>
                            <li>в профайле появилось новое поле "Telegram Chat ID". В нём указывается "chat ID" вашего Телеграм-аккаунта. Если вы хотите получать уведомления, этот номер нужно указать. Узнать свой "chat ID" можно по адресу <span class="font-mono text-red-600">@getmyid_bot</span></li>
                            <li>добавлен новый статус для тикетов - "Postponed". Этот статус получают тикеты, работа по которым временно приостановлена. Причина указывается в комментариях внутри тикета.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-extrabold">Patch 08.06.2023 notes</h3>
                        <ul class="mt-4 pl-6 list-disc">
                            <li>добавлен раздел "Goals" с базовыми инструментами управления;</li>
                            <li>была немного улучшена визуальная часть приложения.</li>
                            <li>исправлены баги с отправкой форм в разделе "Tickets"</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-extrabold">Patch 05.06.2023 notes</h3>
                        <ul class="mt-4 pl-6 list-disc">
                            <li>добавлена пагинация страницы с тикетами для избежания её перегруженности. Кнопки управления пагинацией находятся внизу под общим списком и будут видны только в том случае, когда на странице находится более 10 элементов;</li>
                            <li>добавлены фильтры по статусам в разделе "Tickets": all/new/working/done/closed. Теперь отслеживать новые, обрабатываемые и выполненные тикеты станет проще;</li>
                            <li>добавлена функция поиска по тикетам. Ищет по заголовкам и содержанию. Работает независимо от фильтров и страниц в пагинации;</li>
                            <li>в тикеты добавлено поле "Deadline" и теперь можно назначать крайние сроки выполнения заявок;</li>
                            <li>добавлена возможность загружать файлы (изображения) после создания тикета. Ранее файлы можно было загружать только при создании тикета;</li>
                            <li>кнопка "Show" (показать содержание тикета) была удалена. Теперь для показа содержимого достаточно просто кликнуть по самому тикету в разделе "Tickets";</li>
                            <li>кнопка "Edit" мигрировала из общего списка тикетов внутрь самого тикета;</li>
                            <li>была немного улучшена визуальная часть приложения.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>

</template>
