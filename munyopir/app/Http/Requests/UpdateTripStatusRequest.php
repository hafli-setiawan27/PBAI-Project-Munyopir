<?php

namespace App\Http\Requests;

use App\Enums\TripStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateTripStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('trip')) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(TripStatus::class)],
        ];
    }

    public function after(): array
    {
        return [function (Validator $validator): void {
            if ($validator->errors()->has('status')) {
                return;
            }

            $trip = $this->route('trip');
            $nextStatus = TripStatus::from($this->string('status')->toString());

            if (! $trip->status->canTransitionTo($nextStatus)) {
                $validator->errors()->add('status', 'Perubahan status perjalanan tidak diizinkan.');
            }
        }];
    }
}
