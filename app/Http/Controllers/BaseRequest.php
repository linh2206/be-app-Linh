<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    const REQUIRE_RULE = 'required';
    const ARRAY_RULE = 'array';
    const INTEGER_RULE = 'integer';
    const NUMERIC_RULE = 'numeric';
    const STRING_RULE = 'string';
    const DATE_RULE = 'date';
    const IN_RULE = 'in';
    const HOUR_FORMAT_RULE = "regex:/^\d{2}:\d{2}:\d{2}$/";
    const BIRTHDATE_RULE = 'date|before:tomorrow';
    const EMAIL_RULE = 'email';
    const NULLABLE = 'nullable';
    const BOOLEAN = 'boolean';
    const FILE_RULE = 'file';
    const JSON_RULE = 'json';
    const MAX_LENGTH_15='max:15';
    const MAX_LENGTH_20='max:20';
    const MAX_LENGTH_100='max:100';
    const MAX_LENGTH_255 ='max:255';
    const MAX_LENGTH_500='max:500';
    const RFC_EMAIL_RULE = 'regex:/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-{1,63}[a-z0-9]+)*)))$/';
    const PHONE_RULE = 'regex:/^[0-9()+-]{0,20}$/';
    const IP_RULE = 'ip';
    const FILE_IMAGE_RULE = 'mimes:jpeg,png,jpg|max:1014';
    const IN_RULE_STATUS = 'in:0,1';
    const UNIQUE_RULE = 'unique:';
    const ENUM_VALUE_RULE = 'enum_value:';
  
    /**
     * Get the validation rules that apply to the list w pagination request.
     *
     * @return array
     */
    public function pagingList(): array
    {
        return [
            'page' => self::INTEGER_RULE,
            'limit' => self::INTEGER_RULE,
            'order_by' => self::STRING_RULE,
            'order_type' => self::STRING_RULE,
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}