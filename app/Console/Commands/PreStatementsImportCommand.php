<?php

namespace App\Console\Commands;

use App\Imports\PreStatementsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class PreStatementsImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:statements-checking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from excel (before uploading to MC)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new PreStatementsImport(), public_path('excel/statement_122023.xls'));
        dd('checking is done');
    }
}
