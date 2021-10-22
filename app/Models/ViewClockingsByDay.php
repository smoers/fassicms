<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewClockingsByDay extends Model
{
    use HasFactory;
    public $table = 'view_clockings_by_day';

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getDateAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getTimeAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('H:i') : null;
    }
}
