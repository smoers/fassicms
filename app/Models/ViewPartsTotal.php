<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPartsTotal extends Model
{
    use HasFactory;
    protected $table = 'view_parts_total';

    /**
     * Retourne un objet Part
     *
     * @param $worksheet_id
     * @param string $barcode
     * @return Part|null
     */
    public static function getPartByBarCode($worksheet_id, string $barcode): ? ViewPartsTotal
    {
        return self::where('worksheet_id','=',$worksheet_id)
            ->where('bar_code','=',$barcode)
            ->first();
    }
}
