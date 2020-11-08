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

    /**
     * Retourne l'objet Store lié à l'objet Catalog
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store(){
        return $this->belongsTo(Store::class);
    }

    /**
     * Retourne l'objet Provider lié à l'objet Catalog
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
}
