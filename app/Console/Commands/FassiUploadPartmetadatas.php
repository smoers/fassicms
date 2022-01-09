<?php

namespace App\Console\Commands;

use App\Moco\Commands\UploadPartmetadatas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FassiUploadPartmetadatas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fassi:partmetadata {file} {--D|withDelete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charge les tables partmetadatas, catalogs & stores avec le contenu du fichier CSV';

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
        if (File::exists($this->argument('file'))) {
            $class = new UploadPartmetadatas($this->argument('file'), $this->option('withDelete'));
            $result = $class->upLoad();
            $this->line('Nombre de lignes traitées : '.$result['traited']);
            $this->warn('Nombre de lignes supprimées: '.$result['delete']);
            $this->info('*** '.$result['result'].' ***');
        } else {
            $this->error('Le fichier n\'a pas été trouvé' );
        }
        return 0;
    }
}
