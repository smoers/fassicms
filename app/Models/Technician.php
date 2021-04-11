<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Technician extends Model
{
    use HasFactory;

    /**
     * Retourne les objet Clocking liés à ce technicien
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clockings()
    {
        return $this->hasMany(Clocking::class);
    }

    /**
     * Retourne l'objet User lié à l'objet technicien
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retourne null ou un object Technician
     *
     * @param string $number
     * @param bool $enabled
     * @return Technician|null
     */
    public static function getTechnician(string $number, bool $enabled = true): ?Technician
    {
        return self::where('number','=',$number)->where('enabled','=',$enabled)->first();
    }
}
