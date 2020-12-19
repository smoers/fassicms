<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StorePrice implements Rule
{

    protected $minPrice;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->minPrice = config('moco.store.minPrice');
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
        return floatval(str_replace(',','.',$value)) >= $this->minPrice;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('The minimum value of Price must be ').$this->minPrice;
    }
}
