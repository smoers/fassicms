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
        $return = true;
        if (array_key_exists('serial',$this->data) && array_key_exists('plate',$this->data)) {
            if ($attribute == 'serial') {
                $serial = $value;
                $plate = $this->data['plate'];
            } elseif ($attribute == 'plate') {
                $serial = $this->data['serial'];
                $plate = $value;
            }
            if ($serial != '' && $plate != '')
                $return = !Crane::exist($serial, $plate);
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
