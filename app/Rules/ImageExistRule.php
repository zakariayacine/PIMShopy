<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ImageExistRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        //verification if the url of the image is from local
        if (!file_exists(public_path($value))) {
            //if from server
            try {
               $file = file_get_contents($value);
            } catch (\Throwable $th) {
                $fail('L\'image n\'existe pas !');
            }
        }
    }
}
