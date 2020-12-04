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

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Détermine si un part number exist
     * @param string $part_number
     * @param bool $enabled
     * @return bool
     */
    public static function exist(string $part_number, bool $enabled = true): bool
    {
        return self::where('part_number','=', $part_number)->where('enabled','=',$enabled)->get()->count()== 1 ;
    }

}
