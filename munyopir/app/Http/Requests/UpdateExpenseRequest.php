<?php

namespace App\Http\Requests;

use App\Enums\ExpenseCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'category' => ['required', Rule::enum(ExpenseCategory::class)],
            'amount' => ['required', 'integer', 'min:1'],
            'expense_date' => ['required', 'date_format:Y-m-d'],
            'description' => ['nullable', 'string', 'max:1000'],
            'trip_id' => [
                'nullable',
                Rule::exists('trips', 'id')->where('user_id', $this->user()->id),
            ],
            'receipt' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'category.required' => 'Kategori pengeluaran wajib dipilih.',
            'category.enum' => 'Pilih kategori pengeluaran yang tersedia.',
            'amount.required' => 'Nominal pengeluaran wajib diisi.',
            'amount.integer' => 'Nominal pengeluaran harus berupa angka bulat.',
            'amount.min' => 'Nominal pengeluaran minimal Rp1.',
            'expense_date.required' => 'Tanggal pengeluaran wajib diisi.',
            'expense_date.date_format' => 'Masukkan tanggal pengeluaran yang valid.',
            'description.max' => 'Catatan maksimal 1.000 karakter.',
            'trip_id.exists' => 'Pilih perjalanan milik Anda sendiri.',
            'receipt.image' => 'Bukti pengeluaran harus berupa gambar.',
            'receipt.mimes' => 'Bukti pengeluaran harus berformat JPG, PNG, atau WebP.',
            'receipt.max' => 'Ukuran bukti pengeluaran maksimal 2 MB.',
        ];
    }
}
