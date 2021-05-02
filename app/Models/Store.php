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
        'qty',
        'location',
    ];

    /**
     * Retourne l'objet Partmetadata lié à l'objet Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partmetadata()
    {
        return $this->belongsTo(Partmetadata::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Retourne l'objet User lié à l'objet Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
            return '0';
        } else {
            return number_format(intval($value),0,',','');
        }
    }

    /**
     * Retourne la quantité pour une année précisée
     *
     * @param int|null $year
     * @return int|null
     */
    public function getPrice(int $year = null)
    {
        $catalog = $this->partmetadata()->first()->getCatalog($year);
        return is_null($catalog) ? null : $catalog->price;
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
     * Va retourner un objet Out hydraté et
     * mets à jour l'objet Store au niveau de la quantité
     *
     * @param int $qty_pull
     * @param Reason|null $reason
     * @param string|null $note
     * @return Out|null
     */
    public function getOutHydrated(int $qty_pull, Reason $reason = null, string $note = null): ? Out
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

    /**
     * Va retourner un objet Reassortement hydraté et
     * mets à jour l'objet Store au niveau de la quantité
     *
     * @param int $qty_add
     * @param Reason|null $reason
     * @param string|null $note
     * @return Reassortement|null
     */
    public function getReassortementHydrated(int $qty_add, Reason $reason = null, string $note = null): ?Reassortement
    {
        $reassort = new Reassortement();
        $reassort->qty_add = $qty_add;
        $reassort->qty_before = $this->attributes['qty'];
        $reassort->note = $note;
        $reassort->store()->associate($this);
        $reassort->user()->associate(Auth::user());
        $reassort->reason()->associate($reason);
        $this->increaseQuantity($qty_add);
        return $reassort;

    }


    /**
     * Détermine si un part number exist
     *
     * @param string $part_number
     * @param bool $enabled
     * @return bool
     */
    public static function exist(string $part_number, bool $enabled = true): bool
    {
        return self::where('part_number','=', $part_number)->where('enabled','=',$enabled)->get()->count()== 1 ;
    }

    /**
     * Détermine si le code barre existe dans la table
     *
     * @param string $bar_code
     * @param bool $enabled
     * @return bool
     */
    public static function existBarCode(string $bar_code, bool $enabled = true): bool
    {
        return self::where('bar_code','=', $bar_code)->where('enabled','=',$enabled)->get()->count()== 1 ;
    }

    /**
     * Retourne l'objet Store sur base du part number
     *
     * @param string $part_number
     * @param bool $enabled
     * @param bool $lockForUpdate
     * @return mixed
     */
    public static function getStoreByPartNumber(string $part_number, bool $enabled = true, bool $lockForUpdate = false): ?Store
    {
        if ($lockForUpdate)
            return self::where('part_number','=', $part_number)->where('enabled','=',$enabled)->lockForUpdate()->first();
        else
            return self::where('part_number','=', $part_number)->where('enabled','=',$enabled)->first();
    }

    /**
     * Retourne l'objet Store sur base du code barre
     *
     * @param string $bar_code
     * @param bool $enabled
     * @param bool $lockForUpdate
     * @return mixed
     */
    public static function getStoreByBarCode(string $bar_code, bool $enabled = true, bool $lockForUpdate = false): ?Store
    {
        if ($lockForUpdate)
            return self::where('bar_code','=', $bar_code)->where('enabled','=',$enabled)->lockForUpdate()->first();
        else
            return self::where('bar_code','=', $bar_code)->where('enabled','=',$enabled)->first() ;
    }


}
