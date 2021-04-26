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

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = ['price','year'];

    /**
     * Retourne l'objet Partmetadata lié à l'objet Catalog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partmetadata()
    {
        return $this->belongsTo(Partmetadata::class);
    }

    /**
     * Retourne l'objet User lié à l'objet Catalog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retourne l'objet Provider lié à l'objet Catalog
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    /*
     * Convertir en format MySQL
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = floatval(str_replace(',','.',$value));
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getPriceAttribute($value)
    {
        if($value == ''){
            return null;
        } else {
            return number_format(floatval(str_replace(',', '.', $value)), 2, ',', '');
        }
    }

    /**
     * Cast la valeur reassort_level
     *
     * @param $value
     */
    public function setReassortLevelAttribute($value)
    {
        $this->attributes['reassort_level'] = intval($value);
    }

    /**
     * Format la valeur reassort_level
     *
     * @param $value
     * @return string|null
     */
    public function getReassortLevelAttribute($value): ?string
    {
        if($value == ''){
            return '0';
        } else {
            return number_format(intval($value),0,',','');
        }
    }
}
