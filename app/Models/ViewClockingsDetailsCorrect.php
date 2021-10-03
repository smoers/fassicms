<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewClockingsDetailsCorrect extends Model
{
    use HasFactory;
    public $table = 'view_clockings_details_correct';

    /**
     * Retourne l'heure uniquement
     *
     * @return string|null
     */
    public function getTime(): ?string
    {
        return Carbon::parse($this->attributes['time'])->format('H:i');
    }

    /**
     * Retourne uniquement la date
     *
     * @return string|null
     */
    public function getDate(): ?string
    {
        return Carbon::parse($this->attributes['date'])->format('d/m/Y');
    }
}
