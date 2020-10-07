<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BulletinActiveDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $activeDate;

    public function __construct($activeDate)
    {
        $this->activeDate = $activeDate;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $date = explode(' / ', $this->activeDate);
        $activeDate = array(
            'start_date' => $date[0],
            'end_date' => $date[1],
        );
        $validator = Validator::make($activeDate, [
            'start_date' => 'required|before_or_equal:end_date',
            'end_date' => 'required|after_or_equal:start_date',
        ]);
        if ($validator->fails()) {
            return false;
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
        return ':attribute format is wrong';
    }
}
