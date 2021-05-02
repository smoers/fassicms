<?php

namespace App\Models;

use Carbon\Carbon;
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

    /**
     * Retourne l'objet Catalog pour une année précisée
     *
     * @param int|null $year
     * @return Catalog
     */
    public function getCatalog(int $year = null): ?Catalog
    {
        if (is_null($year))
            $year = Carbon::now()->year;
        /**
         * recherche l'objet Catalog pour une année précise
         */
        return Catalog::where('partmetadata_id','=',$this->attributes['id'])->where('year','=',$year)->first();
    }

    /**
     * Retourne le prix pour une année précisée
     *
     * @param int|null $year
     * @return int|null
     */
    public function getPrice(int $year = null)
    {
        $catalog = $this->getCatalog($year);
        return is_null($catalog) ? null : $catalog->price;
    }

    /**
     * Retourne un objet Store sur base de l'emplacement
     *
     * @param int $location_id
     * @return Store|null
     */
    public function getStoreByLocation(int $location_id): ?Store
    {
        return $this->stores()->where('location_id','=',$location_id)->first();
    }

}
