<?php

namespace App\Console\Commands;

use App\Imports\StatementsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class StatementsImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:statement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new StatementsImport(), public_path('excel/statement.xls'));
        dd('done');
    }
}
