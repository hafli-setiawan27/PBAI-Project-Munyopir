<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'plate_number' => ['required', 'string', 'max:20'],
            'current_odometer' => ['required', 'integer', 'min:0', 'max:4294967295'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama kendaraan wajib diisi.',
            'plate_number.required' => 'Nomor polisi wajib diisi.',
            'current_odometer.required' => 'Odometer wajib diisi.',
            'current_odometer.integer' => 'Odometer harus berupa angka.',
            'current_odometer.min' => 'Odometer tidak boleh kurang dari 0.',
            'current_odometer.max' => 'Odometer terlalu besar.',
        ];
    }
}
