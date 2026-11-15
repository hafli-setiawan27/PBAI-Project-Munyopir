<?php

namespace App\Http\Requests;

use App\Models\Trip;
use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', Trip::class) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'destination' => ['required', 'string', 'max:150'],
            'pickup_location' => ['required', 'string', 'max:150'],
            'pickup_at' => ['required', 'date_format:Y-m-d\TH:i'],
        ];
    }
}
