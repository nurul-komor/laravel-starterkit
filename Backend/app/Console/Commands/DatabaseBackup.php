<?php

namespace App\Console\Commands;

use App\Models\DatabaseTableBackup;
use Illuminate\Console\Command;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbsql:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create mysql database backup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = 'backup_'.strtotime(now()).'.sql';

        $command = 'mysqldump --user='.env('DB_USERNAME').' --password='.env('DB_PASSWORD').' --host='.env('DB_HOST').' '.env('DB_DATABASE').' > '.storage_path().'/app/backups/'.$filename;

        DatabaseTableBackup::create([
            'file_name' => $filename,
        ]);
        exec($command);
    }
}
