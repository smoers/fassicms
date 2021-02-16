<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewClockingExtended extends Model
{
    use HasFactory;
    public $table = 'view_clocking_extended';

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getStartDateAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getStopDateAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getStartTimeAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('H:i') : null;
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getStopTimeAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('H:i') : null;
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getDiffAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('H:i') : null;
    }
}
