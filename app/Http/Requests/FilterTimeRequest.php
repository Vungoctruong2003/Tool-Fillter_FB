<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterTimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'page_id' => 'required|integer|exists:customer_pages,page_code',
            'limit' => 'required|lt:1000|gt:0',
            'begin_time' => 'required|date_format:Y-m-d',
            'end_time' => 'required|date_format:Y-m-d'
        ];
    }
}
