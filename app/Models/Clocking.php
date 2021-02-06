<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clocking extends Model
{
    use HasFactory;

    /**
     * Retourne l'objet User lié à l'objet Clocking
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retourne l'objet Worksheet lié à l'objet Clocking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worksheet()
    {
        return $this->belongsTo(Worksheet::class);
    }

    /**
     * Retourne l'objet Technicien lié à l'objet Clocking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

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
    public function getDateAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('d/m/Y H:i') : null;
    }

    /**
     * Place la date avec le format correct dans l'attribut
     *
     * @param $value
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse(str_replace('/','-',$value));
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getStartDateAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('d/m/Y H:i') : null;
    }

    /**
     * Place la date avec le format correct dans l'attribut
     *
     * @param $value
     */
    public function setStopDateAttribute($value)
    {
        $this->attributes['stop_date'] = Carbon::parse(str_replace('/','-',$value));
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getStopDateAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('d/m/Y H:i') : null;
    }

    /**
     * Retourne l'heure uniquement
     *
     * @return string|null
     */
    public function getStartTime(): ?string
    {
        return Carbon::parse($this->attributes['start_date'])->format('H:i');
    }

    /**
     * Place la heure en combinaison avec la date
     *
     * @param string $time
     */
    public function setStartDateTime(string $date, string $time){
        $this->attributes['start_date'] = Carbon::parse(str_replace('/','-',"$date $time"));
    }

    /**
     * Retourne l'heure uniquement
     *
     * @return string|null
     */
    public function getStopTime(): ?string
    {
        return Carbon::parse($this->attributes['stop_date'])->format('H:i');
    }

    /**
     * Place la heure en combinaison avec la date
     *
     * @param string $time
     */
    public function setStopDateTime(string $date, string $time){
        $this->attributes['stop_date'] = Carbon::parse(str_replace('/','-',"$date $time"));
    }

    /**
     * Retourne uniquement la start date
     *
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return Carbon::parse($this->attributes['start_date'])->format('d/m/Y');
    }

    /**
     * Retourne uniquement la stop date
     *
     * @return string|null
     */
    public function getStopDate(): ?string
    {
        return Carbon::parse($this->attributes['stop_date'])->format('d/m/Y');
    }

    /**
     * Retourne la difference en heures:minutes
     *
     * @return string
     */
    public function getDiff(): ?string
    {
        $date_1 = new Carbon($this->attributes['start_date']);
        $date_2 = new Carbon($this->attributes['stop_date']);
        return $date_1->diff($date_2)->format('%H:%I');
    }
}
