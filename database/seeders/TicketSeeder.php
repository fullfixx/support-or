<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tickets')->insert([
            'title' => 'Контактная форма Contact Us',
            'description' => 'Перестала работать контактная форма в разделе Contact Us. Когда перестала работать не известно. Заметили недавно.',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Изменилися reply to в письмах',
            'description' => 'так как мы шлем все письма через гмаил, раньше у нас всегда стоял reply to: адрес клиента, сейчас мы обнаружили что по умолчанию reply to: стоит на info@oneride.eu с которого письма приходят. можем в приритетном порядке, посомтреть что поменялось. может после переезда. или перенастройки почты. Так же я сейчас  обнаружил что у нас и другие емаилы не работают. И в том числе service@oneride.eu. Можешь плс настроить емаилы julija@oneride.eu, paul@oneride.eu и service@oneride.eu. В том числе и в гмаиле. Чтоб они приходили, они там в принципе есть, но сейчас не работают',
            'priority' => 1,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Пропал блок с контактной информацией',
            'description' => 'в разделе контакты - были указаны адрес телефон итд, выла левая панель, сейчас она пропала',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Сделать учетку для сервисного менеджера',
            'description' => 'Сделать учетку в админке для нового сотрудника, который будет читать в админке сервисные обращения от клиентов и отвечать на них',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Письма о стоке идут не туда',
            'description' => 'можешь посмотреть, поменять, чтобы инфа про не в соке шла не на мой личный а на info@oneride.eu. когда товар кончается на сайте, стояло 2 штуки и обе две купили, сайт шлет письмо, товар не в стоке. сейчас это письмо падает на nomadique@gmail.com. прошу поменять этот емали на info@oneride.eu. чтоб инфа падала об этом на общий емаил. это вообще рассылка всем супер админам. надо только на инфо. ',
            'priority' => 2,
            'status_id' => 2,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Сделать ролик с поездкой с инста360',
            'description' => 'видео с инста360 что я тебе скидывал, так как времени записать саундтрек к нему нету, мы с Гарри поговорили, может просто под музыку можно что то смонтировать? И Титрами пустить какую то инфу, сколько там заряд баток после какого пробега, из того что я в видео гвоорю и все. сделать ролик минут на 10? чтоб хоть как то материал не пропал. просто чтоб материал не пропал, выложить отчет о поездке и сравнении, там я старался называть на остановках и ночевках сколько пройдено, какая батка, плюс скрины по моему кидал. где то можно просто наинтерполировать. где то можно просто наинтерполировать. без голоса, чисто под музычку и титры +) Как ведет себя подвеска тоже можно какими то титрами давать. типо с22 зашибись, мастер пробивате, с22 засоряется, и уже слабо шарашит, мастер хорош на гладильной доске, с22 хорош на брустальных кочках и деревьях. ',
            'priority' => 3,
            'status_id' => 2,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Баннер реорганизация склада',
            'description' => 'сделать баннер на главную, на английском что в связи с большой реорганизацией склада некоторые заказы в ближайшее время могут задерживаться, особенно это касается отправки запчастей, которые могут задерживаться в отправке до недели. Просим нас понять, ожидаем завершить процесс к концу марта и радовать всех дальше нашим отличным сервисом. и сделаем блог пост. на который пойдет ссылка с баннера. и там уже пояснительный текст. Hey everyone, thank you for your constant support of our team for all these years. As some of you may know already we are going through major stock reorganisation at this time. This is for the better and soon our best on the market service will start to set even higher standarts. 
But at this time we are kindly asking you to be patient. In march we will be going through the biggest changes and some orders might be delayed. This is especially true for the spare parts, that can be delayed significantly. We kindly asking you to be patient, and hopefuly very soon our top delivery and service speeds will make happy every our client.
Your Oneride team!',
            'priority' => 1,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Люди фишат мой телефон с сайта',
            'description' => 'посмотреть  мой телефон в коде сейчас открыт или нет. Так как мне звонят жертвы спама что я им звонил. Потому что нехорошие люди фишат мой телефон с сайта. И там вроде был способ сделать так чтобы телефон по крайней мере для ботов не отсвечмвал. После переезда вроде это отвалилось. ',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Люди не могут прикрепить видео к тикетам',
            'description' => 'люди не могут прикрепить видео к тикетам. Т.е. не каждый знает куда его надо закачать , чтобы получить ссылку. Надо как-то решить эту проблему, т.к. они пытаются слать эти видео мне и на почту и потом мы концов не найдём',
            'priority' => 3,
            'status_id' => 2,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Доставка без ндс в счетах',
            'description' => 'Доставка без ндс в счетах. Доставка 20 евро стоит с ндс(21%). А у нас сейчас во всех таких счета доставка не обложена налогом и налог в итоге надо вручную пересчитывать т исправлять счета. ',
            'priority' => 1,
            'status_id' => 3,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Неправильно настроены инвойсы для экспорта',
            'description' => 'неправильно настроены инвойсы для экспорта. Без НДС может быть только для экспортируемого товара, соответственно, не на адрес инвойса надо смотреть, а на адрес доставки',
            'priority' => 1,
            'status_id' => 3,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Протестировать интеграцию Zoho c какой-нибудь Wordpress или Presta',
            'description' => 'Протестировать интеграцию Zoho c какой-нибудь Wordpress или Presta, посмотреть, какие есть плагины, какие поля обновляются, какие - нет. Посмотреть, как выстроены основные бизнес-процессы в Zoho',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Почему-то слайдер не обновляется',
            'description' => 'Почему-то слайдер не обновляется. Я его изменила в обоих языках. Я про то, что на сайт если захожу, то старая версия там. Времени много прошло уже',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Обновление курса валют',
            'description' => 'Можешь подсказать где курс менялся валют. У нас он ручной стоит и очень плохой. Может можно поставить, чтобы всётаки автоматически обновлялся?. ',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Валюта на сайте меняется сама по себе',
            'description' => 'Вижу евро обычно, но у многих не евро появляется и сегодня у меня тожн так случилось. Может это связано с испанским языком, не знаю. Я когда ссылки открываю от клиентов, то в этой валюте тоже открываются. У нас сейчас заказ пришёл оплачен в этой валюте с Испании. Т.е. человек видит сайт с ней и не знал как поменять. ',
            'priority' => 2,
            'status_id' => 2,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Не обновляется слайдер',
            'description' => 'Вчера включили новый слайдер и он не появляется не только у меня.На испанском появился, а на англ. нет. И это со вчерашнего вечера. Раньше такого не было, пару минут мог не обновляться. А теперь непонятно что с ними происходит. ',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Формирование товарной номенклатуры',
            'description' => 'Формирование товарной номенклатуры для новой системы учета в Zoho. Прописать для каждого наименования категории и подкатегории, ввести систему SKU, подготовить таблицы к загрузке в программу товарного учета.',
            'priority' => 1,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Аудит сайта',
            'description' => 'пройтись по сайту и посмотреть устаревшую инфу - поправить, поудалять, если что то не ясно спросить, там баннеры уже с неактуальной инфой, может те что устарели выключить, сток реогранизейшн тоже выключить, обновить тексты актуальные. Кто то писал что у нас по с22 про написано что они будут в Январе, это страя инфа сейчас партия будет в мае, надо обновить, где то может еще что то, фотки старых моделей итд. все ли колеса которые у нас есть в стоке по этим таблицам есть в стоке на сайте и наоброт, нет ли на сайте чего то лишнего из того что у нас нет. но перед этим наверное стоит сделать из этой таблицы что то удобо читаемой. т.е. там таблицы по складам, надо сотавить их по складам но сделать сводную таблицу где будет виден весь сток и при этом оставить возмонжность списывать колеса со стока - как сейчас видно кол-во продаж и коментарий куда они продались. т.е. оставить функционал какой пока есть но при этом навести красоту и наглядность +)',
            'priority' => 3,
            'status_id' => 2,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Создать учетку для маркетолога в админке сайта',
            'description' => 'Создать учетку для маркетолога. можешь сделать какой то ограниченый аккаунт, пусть не полностью но без клиентов и заказов, но с этим плагином? просто надо чтоб маркетинговый чел настроил выдачу гугл продуктов',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'У сервисного менеджера показываются не все тикеты',
            'description' => 'у нас тут проблема с аккаунтом инженера, я создал аккаунт и дал ему роль инженера, которую ты создавал для Саши, но у человека не показываются все тикеты. у него их 54и последних нету, у меня 86. можешь сейчас сделать паузу и заняться этим вопросом, так как у нас пока проблема, он должен отвечать на тикеты, а он не отвечает так как их не видит',
            'priority' => 1,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Протестировать другие системы товарного учета',
            'description' => 'Zoho не полностью удовлетворяет наши зпросы. Нужно потестировать другие. Проверить возможности интеграции с интернет-витринами',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Сделать шаблоны инвойсов для МС',
            'description' => 'я тебе пришлю образцы инвойсов на латв и на испанские компании. И ты попробуешь сделать шаблоны. Что в моем складе работали. ',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Изучить доступные интеграции Presta и МойСклад',
            'description' => 'Изучить доступные интеграции Presta и МойСклад. Пообщаться с исполнителями, запросить цены, сроки',
            'priority' => 3,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Интеграция через студента за 5к руб',
            'description' => 'Пробуем интеграцию через студента за 5000 рублей. Подключаем, тестируем',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'GTIN коды для рекламщиков',
            'description' => 'проставить эти коды для колес, если они есть реальные то реальные, если их в природе не существует реальных то тогда просто сгенерировать',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Неправильный Reply to',
            'description' => 'по сервисным тикетам у нас не правильный реплай ту. письмо шлется от сервис@oneride. а отвечает он на info@',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Доработать таблицу и загрузить в МС',
            'description' => 'Доработать таблицу после изначальной инвентаризации, прописать SKU и загрузить в МС',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Исправить проблему с вариативными товарами в таблице',
            'description' => 'Исправить проблему с вариативными товарами в таблице. Заменить #1, #2, #3 и т.д. на нормально читаемые окончания',
            'priority' => 1,
            'status_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Интеграция с Helpist',
            'description' => 'Заказываем и реализуем интеграцию МС c Presta у Helpist с ориентировочной ценой 35-50к рублей и сроками 10-20 дней',
            'priority' => 2,
            'status_id' => 2,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Сделать шаблон с минусом для возврата покупателя',
            'description' => 'Сделать шаблон с минусом для возврата покупателя. За основу взять обычный счет на опату. Изменить название, проставить во всех полях с ценами минусы и сделать так, чтобы поле Примечание выводилось на печать.',
            'priority' => 2,
            'status_id' => 3,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
    }
}
