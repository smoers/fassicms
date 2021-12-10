<?php
/*
 * Copyright (c) 2021. MO Consult
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
 *  Date : 5/12/21 13:09
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 05-12-21
 */

namespace App\Moco\Common;

use App\Models\TrucksCrane;

class TruckCraneHistory
{
    private string $serial = '';
    private string $plate = '';

    /**
     * @param string $serial
     * @param string $plate
     */
    public function __construct(string $serial, string $plate)
    {
        $this->serial = $serial;
        $this->plate = $plate;
    }

    /**
     * Retourne une liste the model contenant l'historique de la grue et du camion
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getHistory()
    {
        return TrucksCrane::query()->leftjoin('customers', 'customers.id', '=', 'trucks_cranes.customer_id')
                ->where('serial','=',$this->serial)
                ->orWhere('plate','=',$this->plate)
                ->orderBy('current','desc')
                ->orderBy('date_current','desc')
                ->get();
    }

}
