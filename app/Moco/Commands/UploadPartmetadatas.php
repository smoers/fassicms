<?php
/*
 * Copyright (c) 2022. MO Consult
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 *
 *  Company : Fassi Belgium
 *  Developer : MO Consult
 *  Author : Moers Serge
 *  Date : 2/01/22 16:10
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 02-01-22
 */

namespace App\Moco\Commands;


use App\Moco\Common\Moco;
use App\Models\Catalog;
use App\Models\Location;
use App\Models\Partmetadata;
use App\Models\Provider;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class UploadPartmetadatas
{
    protected string $file;
    protected bool $withDelete;
    protected string $key;
    protected LoggerInterface $log;
    protected ?User $user;

    /**
     * @param string $file
     * @param bool $withDelete
     */
    public function __construct(string $file, bool $withDelete = false )
    {
        $this->file = $file;
        $this->withDelete =$withDelete;
        $this->key = Moco::randomKey();
        $this->log = new Logger('import');
        $this->log->pushHandler(new StreamHandler(storage_path('logs/import/log-import-'. Carbon::now()->isoFormat('Y-MM-DD-HHmmss').'.log')));
        if (is_null($this->user = Auth::user()))
            $this->user = User::firstWhere('email','admin@mo-consult.be');

    }

    public function upLoad()
    {
        $this->log->info('Le fichier '.$this->file.' est chargé avec la clé : '.$this->key);
        /**
         * Converti le contenu du fichier en tableau
         */
        $lines = file($this->file,FILE_SKIP_EMPTY_LINES);
        /**
         * Tableau des valeurs à enregistrer
         */
        $records = [];
        /**
         * Lecture des entêtes
         */
        $header = str_getcsv($lines[0],';');
        /**
         * supprime la ligne avec les entêtes
         */
        unset($lines[0]);
        /**
         * compteur
         */
        $count = 0;
        /**
         * Parcoure le tableau pour préparer le tableau d'enregistrement
         */
        foreach ($lines as $line){
            /**
             * Converti la ligne
             */
            $line_array = str_getcsv($line,';');
            /**
             * Init le record
             */
            $record = [];
            /**
             * crée le record avec les entête comme clès
             */
            for ($i = 0; $i < count($line_array); $i++){
                $record[$header[$i]] = $line_array[$i];
            }
            /**
             * ajoute le record dans le tableau des records
             */
            array_push($records,$record);
            $count++;
        }
        $this->log->info($count.' numéro de pièce trouvé dans le fichier CSV');
        /**
         * Dump the la database
         */
        Artisan::call('db:backup --data_only --tables partmetadatas --tables catalogs --tables stores --tables outs --tables reassortements');
        /**
         * Mise à jour du stock
         */
        $count = 0;
        foreach ($records as $record){
            $count++;
            $msg_log = 'index: '.$count.' - P/N: '.$record['part_number'];
            /**
             * Recherche l'emplacement du stock
             */
            $location = Location::firstWhere('location',$record['location']);
            /**
             * on ne charge les données que si l'emplacement du stock existe
             */
            if (!is_null($location)) {
                /**
                 * Recherche le fournisseur
                 */
                $provider = Provider::find($record['provider_id']);
                if (is_null($provider))
                    $provider = Provider::find(1);
                /**
                 * Recherche part_number
                 */
                $partmetadata = Partmetadata::firstWhere('part_number', $record['part_number']);
                /**
                 * Si null on crée l'objet
                 */
                if (is_null($partmetadata)) {
                    $partmetadata = new Partmetadata();
                    $store = new Store();
                    $catalog = new Catalog();
                    $msg_log .= ' nouvel enregistrement méta données, stock et catalogue.';
                } else {
                    $msg_log .= ' méta données existantes,';
                    /**
                     * recherche le stock
                     */
                    $store = $partmetadata->getStoreByLocation($location->id);
                    if (is_null($store)) {
                        $store = new Store();
                        $msg_log .= ' nouveau stock,';
                    } else {
                        $msg_log .= ' stock existant,';
                    }
                    /**
                     * recherche le catalogue
                     */
                    $catalog = $partmetadata->getCatalog($record['year']);
                    if (is_null($catalog)) {
                        $catalog = new Catalog();
                        $msg_log .= 'nouveau catalogue.';
                    } else {
                        $msg_log .= 'catalogue existant.';
                    }
                }
                /**
                 * on hydrate l'objet
                 */
                if ($partmetadata->import_key != $this->key) {
                    $partmetadata->part_number = $record['part_number'];
                    $partmetadata->description = $record['description'];
                    $partmetadata->enabled = true;
                    $partmetadata->electrical_part = $record['electrical_part'];
                    $partmetadata->bar_code = $record['bar_code'];
                    $partmetadata->reassort_level = $record['reassort_level'];
                    $partmetadata->user()->associate($this->user);
                    $partmetadata->import_key = $this->key;
                }
                if ($store->import_key != $this->key){
                    $store->qty = $record['qty'];
                    $store->location()->associate($location);
                    $store->user()->associate($this->user);
                    $store->import_key = $this->key;
                }
                if ($catalog->import_key != $this->key){
                    $catalog->price = $record['price'];
                    $catalog->year = $record['year'];
                    $catalog->provider()->associate($provider);
                    $catalog->user()->associate($this->user);
                    $catalog->import_key = $this->key;
                }

                $exception = DB::transaction(function () use ($partmetadata, $store, $catalog) {
                   $partmetadata->save();
                   $store->partmetadata()->associate($partmetadata)->save();
                   $catalog->partmetadata()->associate($partmetadata)->save();

                });

                if ($exception){
                    $msg_log .= ' - Enregistrement a généré une erreur: '.$exception->getMessage();
                    $this->log->error($msg_log);
                } else {
                    $msg_log .= ' - Enregistrement effectué avec succès';
                    $this->log->notice($msg_log);
                }


            } else {
                $this->log->warning($msg_log.' - Line: '.($count+1).' - Emplacement de stock inexistant: ');
            }

        }

        $count_delete = 0;
        if ($this->withDelete){
            $count_delete = Partmetadata::where('import_key','!=',$this->key)->orWhere('import_key','=',null)->count();
            Partmetadata::where('import_key','!=',$this->key)->orWhere('import_key','=',null)->delete();
            $this->log->warning($count_delete.' enregistrement ont été supprimé');
        }

        return [
            'result' => 'success',
            'traited' => $count,
            'delete' => $count_delete,
        ];
    }


}
