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
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model implements MocoModelForConsultInterface
{
    use HasFactory, MocoModelCreatedUpdatedAt;

    protected $fillable = [
        'number',
        'date',
        'remarks',
        'work',
        'oil_replace',
        'oil_filtered',
        'warranty',
    ];

    /**
     * Liste des relations utilisée pour le formulaire de consultation
     *
     * @var string[]
     */
    protected $withForConsult = ['customer','crane','parts','clockings','user'];

    /**
     * Retourne l'objet Customer lié à l'objet Worksheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    /**
     * Retourne l'objet Crane lié à l'objet Worksheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function crane(){
        return $this->belongsTo(Crane::class);
    }

    /**
     * Retourne les objets Part lié à l'objet Worksheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    /**
     * Retourne les objets Clocking lié à l'objet Worksheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clockings()
    {
        return $this->hasMany(Clocking::class);
    }

    /**
     * Retourne l'objet User lié à l'objet Worksheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * place la valeur au bon type
     *
     * @param $value
     */
    public function setOilReplaceAttribute($value)
    {
        $this->attributes['oil_replace'] = floatval(str_replace(',','.',$value));
    }

    /**
     * retroune la valeur au bon format
     *
     * @param $value
     * @return string|null
     */
    public function getOilReplaceAttribute($value)
    {
        if($value == ''){
            return '0';
        } else {
            return number_format(floatval(str_replace(',', '.', $value)), 2, ',', '');
        }
    }

    /**
     * Place la date avec le format correct dans l'attribut
     *
     * @param $value
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse(str_replace('/','-',$value));
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getDateAttribute($value)
    {
        $return = null;
        if ($value != ''){
            $return = Carbon::parse($value)->format('d/m/Y');
        }
        return $return;
    }


    public function WithForConsult()
    {
        return $this->withForConsult;
    }
}
