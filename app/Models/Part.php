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
 *
 *  Company : Fassi Belgium
 *  Developer : MO Consult
 *  Author : Moers Serge
 *  Date : 4/12/20 14:31
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_number',
        'bar_code',
        'qty',
    ];

    /**
     * Retourne le User lié à cette object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retourne le Worksheet lié à cette object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worksheet()
    {
        return $this->belongsTo(Worksheet::class);
    }

    /**
     * Retourne la location pour cette pièce
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
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
            return number_format(intval($value),0,',','.');
        }
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
            return number_format(floatval(str_replace(',', '.', $value)), 2, ',', '.');
        }
    }

    public function getTotal(): ?string
    {
        if (is_null($this->attributes['qty']) || is_null($this->attributes['price'])){
            return null;
        } else {
            return number_format(intval($this->attributes['qty'])* floatval($this->attributes['price']),2,',','.');
        }
    }
}
