<?php
/*
 * Copyright (c) 2020. MO Consult
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
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 08-11-20
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_number',
        'description',
        'qty',
        'location',
        'enabled'
    ];

    /**
     * Retourne les objets Catalog pour cet objet Store
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function catalogs(){
        return $this->hasMany(Catalog::class);
    }

    /**
     * Retourne les objets Reassortement pour cet objet Store
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reassortements(){
        return $this->hasMany(Reassortement::class);
    }

    /**
     * Retourne les objets Out pour cet objet Store
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outs(){
        return $this->hasMany(Out::class);
    }

    /*
* Convertir en format MySQL
*/
    public function setQtyAttribute($value)
    {
        $this->attributes['qty'] = intval($value);
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getQtyAttribute($value)
    {
        if($value == ''){
            return null;
        } else {
            return number_format(intval($value),0,',','');
        }
    }

    /**
     * Retourne l'objet Catalog pour une année précisée
     *
     * @param int|null $year
     * @return Catalog
     */
    public function getCatalog(int $year = null): Catalog
    {
        if (is_null($year))
            $year = Carbon::now()->year;
        //recherche l'object Catalog pour une année précise
        return Catalog::where('store_id','=',$this->attributes['id'])->where('year','=',$year)->first();
    }

    /**
     * Retourne la quantité pour une année précisée
     *
     * @param int|null $year
     * @return int|null
     */
    public function getPrice(int $year = null)
    {
        $catalog = $this->getCatalog($year);
        return is_null($catalog) ? null : $catalog->price;
    }

    /**
     * Cette méthode va retourner le prix et l'année
     * L'année utilisée pour retrouver le prix l'année actuelle
     * ou actuelle -1
     *
     * @return array
     */
    public function getPriceForWorksheet(): array
    {
        $year = Carbon::now()->year;
        if (is_null($price = $this->getPrice($year))){
            --$year;
            $price = $this->getPrice($year);
        }

        return [
            'year' => $year,
            'price' => $price,
        ];
    }

    /**
     * Détermine si un part number exist
     * @param string $part_number
     * @param bool $enabled
     * @return bool
     */
    public static function exist(string $part_number, bool $enabled = true): bool
    {
        return self::where('part_number','=', $part_number)->where('enabled','=',$enabled)->get()->count()== 1 ;
    }

    /**
     * @param int $inc_qty
     */
    public function increaseQuantity(int $inc_qty)
    {
        $this->attributes['qty'] += $inc_qty;
    }

    /**
     * @param int $dec_qty
     */
    public function decreaseQuantity(int $dec_qty)
    {
        if ($this->validateAvailableQuantity($dec_qty)){
            $this->attributes['qty'] -= $dec_qty;
        }
    }

    /**
     * @param int $qty_pull
     * @return bool
     */
    public function validateAvailableQuantity(int $qty_pull)
    {
        return $qty_pull <= $this->attributes['qty'];
    }

    /**
     * @param int $qty_pull
     * @param Reason|null $reason
     * @param string|null $note
     * @return Out|null
     */
    public function getOutHydrated(int $qty_pull, Reason $reason = null, string $note = null)
    {
        $out = null;
        if ($this->validateAvailableQuantity($qty_pull)){
            $out = new Out();
            $out->qty_pull = $qty_pull;
            $out->qty_before = $this->attributes['qty'];
            $out->reason()->associate($reason);
            $out->store()->associate($this);
            $out->user()->associate(Auth::user());
            $out->note = $note;
            $this->decreaseQuantity($qty_pull);
        }
        return $out;
    }

}
