<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class AtLeastOneCheckboxChecked implements Rule
{
    /**
     * Run the validation rule.
     *
     */
    public function passes($attribute, $value): bool
    {
        // Check if at least one checkbox is checked
        return is_array($value) && count(array_filter($value)) > 0;
    }

    public function message()
    {
        return 'At least one checkbox must be checked.';
    }
}
