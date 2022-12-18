<?php

namespace App\Http\Controllers;

use App\Moco\Common\Moco;
use App\Models\Catalog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SplFixedArray;

class SystemController extends Controller
{


    public function newYear()
    {
        /**
         * Cosntruction du tableau avec les années
         */
        $current_years = [
            Carbon::now()->year - 1,
            Carbon::now()->year,
            Carbon::now()->year + 1,
            Carbon::now()->year + 2,
        ];
        /**
         * Requête vers la table Catalogs et conversion vers un tableau
         */
        $catalog_years = data_get(Catalog::distinct()->get('year')->toArray(),'*.year');
        /**
         * Différence entre les deux tableaux
         */
        $years = array_diff($current_years,$catalog_years);
        /**
         * Statistique
         */
        $totals = Catalog::select(DB::raw('COUNT(*) as total'),'year')->groupBy('year')->orderBy('year','desc')->get();
        $ref_year = !is_null($totals) ? $totals[0] : null;
        return view('system.new_year',[
            'title' => 'Creation of a catalog for a new year',
            'years' => $years,
            'totals' => $totals,
            'ref_year' => $ref_year,
        ]);
    }

    public function ajaxNewYear(Request $request)
    {
        /**
         * Tableau avec les données retournées vers l'ajax
         */
        $result = [
            'json' => Moco::randomKey(),
            'count' => null,
        ];
        /**
         * on fixe le pourcentage à la bonne valeur
         */
        $pourcentage = round(Moco::floatValReplace($request->pourcentage),3);
        $pourcentage = $pourcentage == 0 ? 1 : ($pourcentage / 100) + 1;
        /**
         * Récupère le catalogue de l'année de référence
         */
        $catalogs = Catalog::query()->where('year','=',$request->ref_year)->get();
        /**
         * Nombre de record retrouvé
         */
        $result['count'] = $catalogs->count();
        /**
         * Init le tableau qui va contenir le nouveaux records
         */
        $array = new SplFixedArray($result['count']);
        /**
         * Parcoure le catalogue
         */
        foreach($catalogs as $key => $record){
            $sub = [
                'id' => $key,
                'price' => round(Moco::floatValReplace($record->price) * $pourcentage,3),
                'year' => $request->year,
                'provider_id' => $record->provider_id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'modified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'partmetadata_id' => $record->partmetadata_id,
                'user_id' => Auth::id()];
            $array[$key] = $sub;
        }
        /**
         * Stocke le tableau obtenu dans un fichier JSON
         */
        Storage::disk('temp')->put($result['json'].'.json',json_encode($array));
        /**
         * Retourne le résultat
         */
        return response()->json($result);
    }
}
