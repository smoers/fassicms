<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StoreSourceQty implements Rule
{
    private $data = null;
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
        if(array_key_exists('src_stock',$this->data)) {
            if (is_null($this->data['src_stock'])) {
                return true;
            } elseif (intval($value) > intval($this->data['src_stock'])) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('The quantity of the source stock is not enough.');
    }
}
