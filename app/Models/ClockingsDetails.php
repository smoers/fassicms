<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClockingsDetails extends Model
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
    public function setDateTimeAttribute($value)
    {
        $this->attributes['date_time'] = Carbon::parse(str_replace('/','-',$value));
    }

    /**
     * Retourne la date au format correct
     *
     * @param $value
     * @return string|null
     */
    public function getDateTimeAttribute($value): ?string
    {
        return $value != '' ? Carbon::parse($value)->format('d/m/Y H:i') : null;
    }

    /**
     * Retourne uniquement le time
     *
     * @return string
     */
    public function getTime(): ?string
    {
        return Carbon::parse($this->attributes['date_time'])->format('H:i');
    }

    /**
     * Retourne uniquement la date
     *
     * @return string|null
     */
    public function getDate(): ?string
    {
        return Carbon::parse($this->attributes['date_time'])->format('d/m/Y');
    }

    /**
     * Place la heure en combinaison avec la date
     *
     * @param string $time
     */
    public function setDateTime(string $date, string $time){
        $this->attributes['date_time'] = Carbon::parse(str_replace('/','-',"$date $time"));
    }

     /**
     * retourne l'enregsitrement de départ s'il existe
     *      *
     * @param Worksheet $worksheet
     * @param Technician $technician
     * @param string $asExclude
     * @return ClockingsDetails|null
     */
    public static function getStartClocking(Worksheet $worksheet, Technician $technician, string $asExclude = '=' ): ?ClockingsDetails
    {
        $action = config('moco.clocking.actions');
        $status = config('moco.clocking.status');
        return self::where('worksheet_id',$asExclude, $worksheet->id)
                ->where('action','=',$action['start'])
                ->where('status','=',$status['activated'])
                ->where('technician_id','=',$technician->id)
                ->where('date','=', Carbon::now()->format('Y-m-d'))
                ->first();
    }

    /**
     * retourne l'enregistrement de fin s'il existe
     *
     * @param Worksheet $worksheet
     * @param Technician $technician
     * @param string $asExclude
     * @return ClockingsDetails|null
     */
    public static function getStopClocking(Worksheet $worksheet, Technician $technician, string $asExclude = '=' ): ?ClockingsDetails
    {
        $action = config('moco.clocking.actions');
        $status = config('moco.clocking.status');
        return self::where('worksheet_id',$asExclude, $worksheet->id)
            ->where('action','=',$action['stop'])
            ->where('status','=',$status['activated'])
            ->where('technician_id','=',$technician->id)
            ->where('date','=', Carbon::now()->format('Y-m-d'))
            ->first();
    }

    /**
     * crée un enregistrement de départ
     *
     * @param Worksheet $worksheet
     * @param Technician $technician
     * @return ClockingsDetails
     */
    public static function setStartClocking(Worksheet $worksheet, Technician $technician): ClockingsDetails
    {
        $action = config('moco.clocking.actions');
        $status = config('moco.clocking.status');
        $clocking_detail = new ClockingsDetails();
        $clocking_detail->date = Carbon::now()->format('Y-m-d');
        $clocking_detail->date_time = Carbon::now()->format('Y-m-d H:i:s');
        $clocking_detail->action = $action['start'];
        $clocking_detail->status = $status['activated'];
        $clocking_detail->worksheet()->associate($worksheet);
        $clocking_detail->technician()->associate($technician);
        $clocking_detail->user()->associate(Auth::user());
        $clocking_detail->save();
        return $clocking_detail;
    }

    /**
     * Crée un enregistrement de fin
     *
     * @param Worksheet $worksheet
     * @param Technician $technician
     * @return ClockingsDetails
     */
    public static function setStopClocking(Worksheet $worksheet, Technician $technician): ClockingsDetails
    {
        $action = config('moco.clocking.actions');
        $status = config('moco.clocking.status');
        $clocking_detail = new ClockingsDetails();
        $clocking_detail->date = Carbon::now()->format('Y-m-d');
        $clocking_detail->date_time = Carbon::now()->format('Y-m-d H:i:s');
        $clocking_detail->action = $action['stop'];
        $clocking_detail->status = $status['activated'];
        $clocking_detail->worksheet()->associate($worksheet);
        $clocking_detail->technician()->associate($technician);
        $clocking_detail->user()->associate(Auth::user());
        $clocking_detail->save();
        return $clocking_detail;
    }
}
