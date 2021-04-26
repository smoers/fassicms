<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partmetadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_number',
        'description',
        'enabled',
        'electrical_part',
        'bar_code',
        'reassort_level',
    ];

    /**
     * Retourne les objets Catalog lié à l'object Partmetadata
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function catalogs()
    {
        return $this->hasMany(Catalog::class);
    }

    /**
     * Retourne les objets Store lié à l'object Partmetadata
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    /**
     * Retourne l'objet User lié à l'objet Partmetadata
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
