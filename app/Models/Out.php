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

class Out extends Model
{
    use HasFactory;

    /**
     * Retourne l'objet Store lié à l'objet Out
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Retourne l'objet Reason lié à l'objet Out
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }

    /**
     * Retourne l'objet User lié à l'objet Out
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
* Convertir en format MySQL
*/
    public function setQtyPullAttribute($value)
    {
        $this->attributes['qty_pull'] = intval($value);
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getQtyPullAttribute($value)
    {
        if($value == ''){
            return null;
        } else {
            return number_format(intval($value), 0, ',', '');
        }
    }

    /*
    * Convertir en format MySQL
    */
    public function setQtyBeforeAttribute($value)
    {
        $this->attributes['qty_before'] = intval($value);
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getQtyBeforeAttribute($value)
    {
        if($value == ''){
            return null;
        } else {
            return number_format(intval($value), 0, ',', '');
        }
    }
}
