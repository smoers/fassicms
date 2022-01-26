<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup {--D|data_only} {--T|tables=*} {--W|where=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Database Backup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * Log
         */
        $log = new Logger('backup');
        $log->pushHandler(new StreamHandler(storage_path('logs/backup/log-backup-'. Carbon::now()->isoFormat('Y-MM-DD-HHmmss').'.log')));
        /**
         * Log paramêtres
         */
        $log->info($this->option('data_only'));
        $log->info(implode(' ',$this->option('tables')));
        $log->info($this->option('where'));
        /**
         * construit la liste des tables, si des tables sont listées
         */
        $tables='';
        if (!empty($this->option('tables')))
            $tables = implode('-',$this->option('tables')).'-';
        /**
         * intègre la clause Where
         */
        $where = '';
        if ($this->option('where'))
            $where = ' --where="'.$this->option('where').'"';
        /**
         * Doit-on uniquement sauvegarder les données
         */
        $data_only = '';
        if ($this->option('data_only'))
            $data_only = ' --no-create-db --no-create-info';
        /**
         * Contruit le nom du fichier
         */
        $filename = "backup-". $tables . Carbon::now()->isoFormat('Y-MM-DD-HHmmss') . ".sql";
        /**
         * Construit la chaine aved la commande
         */
        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " ". implode(' ', $this->option('tables')) . $where . $data_only . " --skip-extended-insert  > " . storage_path('backup') . "/" . $filename;
        /**
         * Log la ligne de commande
         */
        $log->info($command);
        /**
         * Exécute la commande
         */
        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);
        return $command;
    }
}
