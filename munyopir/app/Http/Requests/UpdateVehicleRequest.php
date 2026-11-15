<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->vehicle()->exists() ?? false;
    }

    public function rules(): array
    {
        $currentOdometer = $this->user()?->vehicle()->value('current_odometer') ?? 0;

        return [
            'name' => ['required', 'string', 'max:100'],
            'plate_number' => ['required', 'string', 'max:20'],
            'current_odometer' => ['required', 'integer', 'min:'.$currentOdometer, 'max:4294967295'],
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
            'current_odometer.max' => 'Odometer terlalu besar.',
            'current_odometer.min' => 'Odometer tidak boleh lebih rendah dari angka sebelumnya.',
        ];
    }
}
