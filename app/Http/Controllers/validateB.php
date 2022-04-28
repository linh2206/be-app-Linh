<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;


class ValidateB extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'         => self::STRING_RULE . '|' . self::REQUIRE_RULE,
            'last_name'              => self::STRING_RULE . '|' . self::REQUIRE_RULE, 
            'email'          => self::STRING_RULE . '|' . self::REQUIRE_RULE,  
            'hobbies'       => self::STRING_RULE . '|' . self::REQUIRE_RULE, 
        ];
    }
}
