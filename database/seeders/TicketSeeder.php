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
            'title' => 'Не отправляется почта 1',
            'description' => 'После отправки письма с адреса mail_01@mail.com на адрес mail_02@mail.com письмо не доходит и на mail_01@mail.com приходит ошибка ERROR #0001000101110 Some error',
            'priority' => 1,
            'status_id' => 1,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Не отправляется почта 2',
            'description' => 'После отправки письма с адреса mail_01@mail.com на адрес mail_02@mail.com письмо не доходит и на mail_01@mail.com приходит ошибка ERROR #0001000101110 Some error',
            'priority' => 2,
            'status_id' => 1,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Не отправляется почта 3',
            'description' => 'После отправки письма с адреса mail_01@mail.com на адрес mail_02@mail.com письмо не доходит и на mail_01@mail.com приходит ошибка ERROR #0001000101110 Some error',
            'priority' => 1,
            'status_id' => 2,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Не отправляется почта 4',
            'description' => 'После отправки письма с адреса mail_01@mail.com на адрес mail_02@mail.com письмо не доходит и на mail_01@mail.com приходит ошибка ERROR #0001000101110 Some error',
            'priority' => 1,
            'status_id' => 3,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Не отправляется почта 5',
            'description' => 'После отправки письма с адреса mail_01@mail.com на адрес mail_02@mail.com письмо не доходит и на mail_01@mail.com приходит ошибка ERROR #0001000101110 Some error',
            'priority' => 2,
            'status_id' => 4,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
        DB::table('tickets')->insert([
            'title' => 'Не отправляется почта 6',
            'description' => 'После отправки письма с адреса mail_01@mail.com на адрес mail_02@mail.com письмо не доходит и на mail_01@mail.com приходит ошибка ERROR #0001000101110 Some error',
            'priority' => 3,
            'status_id' => 3,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'visible' => true
            ]);
    }
}
