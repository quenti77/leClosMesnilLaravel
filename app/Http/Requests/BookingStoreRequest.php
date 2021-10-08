<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        $dateNow = date('Y-m-d');
        return [
            'started_at' => 'required|after:'.$dateNow,
            'finished_at' => 'required|date|after:started_at',
            'nb_adult' => 'required|integer',
            'nb_children' => 'required|integer'
        ];
    }
}
