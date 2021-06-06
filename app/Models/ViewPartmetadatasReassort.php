<?php

namespace App\Models;

use App\Moco\Common\MocoModelCreatedUpdatedAt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPartmetadatasReassort extends Model
{
    use HasFactory, MocoModelCreatedUpdatedAt;
    protected $table = 'view_partmetadatas_reassort';

    /**
     * @param $value
     * @return string|null
     */
    public function getQtyAttribute($value)
    {
        if($value == ''){
            return '0';
        } else {
            return number_format(intval($value),0,',','');
        }
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getReassortLevelttribute($value)
    {
        if($value == ''){
            return '0';
        } else {
            return number_format(intval($value),0,',','');
        }
    }
}
