<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewWorksheetCustomerCrane extends Model
{
    use HasFactory;
    public $table = 'view_worksheets_customers_cranes';

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
}
