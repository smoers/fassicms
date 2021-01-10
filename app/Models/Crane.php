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

class Crane extends Model
{
    use HasFactory;
    protected $fillable =[
        'serial',
        'model',
        'plate',
    ];

    /**
     * Retourne les objets Worksheet pour cet objet Crane
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function worksheets(){
        return $this->hasMany(Worksheet::class);
    }

    /**
     * Retourne l'objet User lié à l'objet Worksheet
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * détermine si la grue existe
     * @param string $serial
     * @param string $plate
     * @return bool
     */
    public static function exist(string $serial, string $plate){
        return self::where('serial','=',$serial)->where('plate','=',$plate)->get()->count() == 1;
    }
}
