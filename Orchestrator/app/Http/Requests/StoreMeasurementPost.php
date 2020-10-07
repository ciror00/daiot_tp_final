<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeasurementPost extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        // 'device_id', 'temperature', 'pressure', 'humidity'
        return [
            'device_id' => 'device_id',
            'temperature' => 'temperature',
            'pressure' => 'pressure',
            'humidity' => 'humidity',
        ];
    }
}
