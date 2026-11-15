<?php

namespace App\Http\Requests;

use App\Models\MaintenanceRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreMaintenanceRuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', MaintenanceRule::class) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'interval_km' => ['nullable', 'integer', 'min:1', 'max:4294967295'],
            'interval_days' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'last_service_odometer' => ['nullable', 'integer', 'min:0', 'max:4294967295'],
            'last_service_date' => ['nullable', 'date_format:Y-m-d'],
            'expires_at' => ['nullable', 'date_format:Y-m-d'],
        ];
    }

    public function after(): array
    {
        return [function (Validator $validator): void {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            if (! $this->filled('interval_km') && ! $this->filled('interval_days') && ! $this->filled('expires_at')) {
                $validator->errors()->add('interval_km', 'Isi interval kilometer, interval waktu, atau tanggal berlaku.');
            }

            if ($this->filled('interval_km') && ! $this->filled('last_service_odometer')) {
                $validator->errors()->add('last_service_odometer', 'Odometer servis terakhir wajib diisi jika memakai interval kilometer.');
            }

            if ($this->filled('interval_days') && ! $this->filled('last_service_date')) {
                $validator->errors()->add('last_service_date', 'Tanggal servis terakhir wajib diisi jika memakai interval waktu.');
            }
        }];
    }
}
