<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewClockingTotal extends Model
{
    use HasFactory;
    public $table = 'view_clocking_total';

    /**
     * Total des heures pour une fiche de travail
     *
     * @param $value
     * @return string|null
     */
    public function getTotalAttribute($value)
    {
        $return = null;
        if ($value != ''){
            $return = Carbon::parse($value)->format('H:i');
        }
        return $return;
    }
}
