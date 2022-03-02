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
 *  Date : 19/12/20 12:03
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 19-12-20
 */

namespace App\Moco\Common;


use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class Moco
{
    /**
     * génére un numéro de fiche de travaille
     *
     * @return int
     */
    public static function worksheetNumber(): int
    {
        return intval(Carbon::now('Europe/Brussels')->format('YmdHis'));
    }

    /**
     * Check si la worksheet existe and son status de validation
     *
     * @param Request $request
     * @return array
     */
    public static function worksheetCheck(Request $request): array
    {
        $worksheet = Worksheet::where('number','=',$request->post('number'))->first();
        if (!is_null($worksheet) && !$worksheet->validated){
            $result = [
                'checked' => true,
                'id' => $worksheet->id,
                'msg' => null,
            ];
        } elseif (!is_null($worksheet) && $worksheet->validated){
            $result = [
                'checked' => false,
                'id' => $worksheet->id,
                'msg' => trans('This worksheet is validated.  No changes are authorized'),
            ];
        } else {
            $result = [
                'checked' => false,
                'id' => null,
                'msg' => trans('This worksheet does not exist in the system'),
            ];
        }
        return $result;
    }

    /**
     * génère un numéro de technicien unique
     *
     * @return string
     * @throws \Exception
     */
    public static function technicianNumber(): string
    {
        $bytes = random_bytes(4);
        return bin2hex($bytes);
    }

    /**
     * gestion simplifée des cookies
     *
     * @param string $name
     * @param bool $remove
     * @param null $value
     * @return array|string|null
     */
    public static function cookie(string $name, bool $remove = false, $value = null, $default = null)
    {
        if ($remove == false && $value == null){
            return Cookie::get($name,$default);
        } elseif ($remove == false && $value != null){
            Cookie::queue($name,$value,2147483647);
        } elseif ($remove){
            Cookie::queue(Cookie::forget($name));
        }
    }

    /**
     * retourne une clé aléatoire
     *
     * @return string
     * @throws \Exception
     */
    public static function randomKey(): string
    {
        $bytes = random_bytes(8);
        return bin2hex($bytes);
    }

    /**
     * Retourne un tableau avec la traduction
     *
     * @param array $array
     * @return array|null
     */
    public static function translateArrayValue(array $array): ?array
    {
        $result = [];
        foreach ($array as $key => $value){
            array_push($result, trans($value));
        }
        return $result;
    }

    /**
     * Converti en Float après avoir remplacé le ',' par '.'
     *
     * @param string $value
     * @return float|null
     */
    public static function floatValReplace(string $value): ?float
    {
        return floatval(str_replace(',','.',$value));
    }

    /**
     * @param string $time
     * @param string $format
     * @return bool|float|int
     */
    public static function timeToExcel(?string $time, string $format = 'H:i')
    {
        if (!is_null($time)) {
            $datetimeExcel = Date::PHPToExcel(Carbon::createFromFormat($format, $time));
            return $datetimeExcel - floor($datetimeExcel);
        }
        return null;
    }

    /**
     * @param string|null $date
     * @param string $format
     * @return float|int|null
     */
    public static function dateTimeToExcel (?string $date, string $format = 'd/m/Y')
    {
        if (!is_null($date)){
            return Date::dateTimeToExcel(Carbon::createFromFormat($format,$date));
        }
        return null;
    }

    /**
     * Format une date 2021-12-11 vers 11/12/2021
     *
     * @param string|null $date
     * @return string|null
     */
    public static function formatDate(? string $date): ?string
    {
        return !is_null($date) && $date !='' ? Carbon::parse($date)->format('d/m/Y') : null;
    }

    /**
     * Format une date 2021-12-11 23:12:45.000 vers 11/12/2021 23:45
     *
     * @param string|null $date
     * @return string|null
     */
    public static function formatDateTime(?string $date): ?string
    {
        return !is_null($date) && $date !='' ? Carbon::parse($date)->format('d/m/Y H:i') : null;
    }

    /**
     * Format une date 2021-12-11 23:12:45.000 vers 23:45
     *
     * @param string|null $date
     * @return string|null
     */
    public static function formatTime(?string $date): ?string
    {
        return !is_null($date) && $date !='' ? Carbon::parse($date)->format('H:i') : null;
    }

    /**
     * S'assure que la date à le bon format
     *
     * @param string $date
     * @param string $separator
     * @return bool
     */
    public static function isDateValidFormat($date, string $separator = '/')
    {
        $dateParts = explode($separator,$date);
        if (count($dateParts) !== 3) return false;

        [$day, $month, $year] = $dateParts;

        if (strlen($day) !== 2) return false;
        if (strlen($month) !== 2) return false;
        if (strlen($year) !== 4) return false;

        return true;

    }
}
