<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPartsSignedValues extends Model
{
    use HasFactory;
    protected $table = 'view_parts_signed_values';

    /**
     * Format la quantité
     *
     * @param $value
     * @return string
     */
    public function getQtyAttribute($value)
    {
        if($value == ''){
            return '0';
        } else {
            return number_format(intval($value),0,',','.');
        }
    }

    /**
     * format la quantité signée
     *
     * @param $value
     * @return int|string
     */
    public function getQtySignedAttribute($value)
    {
        if ($value == '')
            return 0;
        else
            return number_format(floatval($value),0,',','.');

    }

    /**
     * format la prix unitaire signé
     *
     * @param $value
     * @return int|string
     */
    public function getUnitPriceSignedAttribute($value)
    {
        if ($value == '')
            return 0;
        else
            return number_format(floatval($value),2,',','.');
    }

    /**
     * format le prix total signé
     *
     * @param $value
     * @return int|string
     */
    public function getTotalPriceSignedAttribute($value)
    {
        if ($value == '')
            return 0;
        else
            return number_format(floatval($value),2,',','.');
    }

    /**
     * format la date de mise à jour
     *
     * @param $value
     * @return string|null
     */
    public function getUpdatedAtAttribute($value): ?string
    {
        $return = null;
        if ($value != ''){
            $return = Carbon::parse($value)->format('d/m/Y');
        }
        return $return;
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
}
