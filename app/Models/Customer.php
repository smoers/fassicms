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

use App\Moco\Common\MocoModelCreatedUpdatedAt;
use App\Moco\Common\MocoModelForConsultInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements MocoModelForConsultInterface
{
    use HasFactory, MocoModelCreatedUpdatedAt;

    protected $fillable =[
        'name',
        'address',
        'address_optional',
        'city',
        'zipcode',
        'country',
        'mail',
        'phone',
        'mobile',
        'vat',
        'black_listed',
    ];

    /**
     * Liste des relations utilisée pour le formulaire de consultation
     *
     * @var string[]
     */
    protected $withForConsult = ['truckscranes','user','customerscontacts'];

    /**
     * Retourne l'objet User lié à l'objet Worksheet
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retourne les objets Worksheet pour cet objet Customer
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function worksheets(){
        return $this->hasMany(Worksheet::class);
    }

    /**
     * Retourne les objets CustomerContact lié à l'objet Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(CustomerContact::class);
    }

    /**
     * Retourne les objets Truck lié à l'objet Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trucks()
    {
        return $this->hasMany(Truckscrane::class);
    }

    public function WithForConsult()
    {
        return $this->withForConsult;
    }
}
