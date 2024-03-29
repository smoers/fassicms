<?php

namespace App\Models;

use App\Moco\Common\MocoModelCreatedUpdatedAt;
use App\Moco\Common\MocoModelForConsultInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truckscrane extends Model implements MocoModelForConsultInterface
{
    use HasFactory,MocoModelCreatedUpdatedAt;

    protected $fillable =[
        'plate',
        'brand',
        'truck_model',
        'serial',
        'crane_model',
        'current',
        'date_current',
    ];

    /**
     * Liste des relations utilisée pour le formulaire de consultation
     *
     * @var string[]
     */
    protected $withForConsult = ['worksheets','customer','user'];

    /**
     * Retourne l'objet Customer lié à l'objet TrucksCrane
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Retourne l'objet User lié à l'objet TrucksCrane
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retourne les objets Worksheet pour cet objet TrucksCrane
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function worksheets(){
        return $this->hasMany(Worksheet::class);
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getDateCurrentAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    /**
     * Place la date avec le format correct dans l'attribut
     *
     * @param $value
     */
    public function setDateCurrentAttribute($value)
    {
        $this->attributes['date_current'] = Carbon::parse(str_replace('/','-',$value));
    }

    /**
     * @return string[]
     */
    public function WithForConsult(): array
    {
        return $this->withForConsult;
    }


}
