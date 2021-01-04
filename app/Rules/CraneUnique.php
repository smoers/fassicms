<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Crane;

class CraneUnique implements Rule
{
    private $data;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /**
         * Par défaut
         */
        $return = true;
        /**
         * Si les deux key existe
         */
        if (array_key_exists('serial', $this->data) && array_key_exists('plate', $this->data)) {
            /**
             * Si on contrôle le serial
             */
            if ($attribute == 'serial') {
                $serial = $value;
                $plate = $this->data['plate'];
                /**
                 * Si on contrôle le plate
                 */
            } elseif ($attribute == 'plate') {
                $serial = $this->data['serial'];
                $plate = $value;
            }
            /**
             * Check l'existence
             */
            if ($serial != '' && $plate != '') {

                $crane = new Crane();
                /**
                 * Dans le cas d'un update on récupère l'objet
                 */
                if (array_key_exists('id', $this->data) && $this->data['id'] != null) {
                    $crane = Crane::find($this->data['id']);
                }
                $return = !Crane::exist($serial, $plate) || ($crane->serial == $serial && $crane->plate == $plate && Crane::exist($serial, $plate));
            }
        }
        return $return;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('The combination between the serial and the plate already exist');
    }
}
