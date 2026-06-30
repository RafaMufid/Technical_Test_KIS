<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VerifyParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'peserta' => 'required|uuid|exists:tbl_participant,id',
            'status'  => 'required|in:TERIMA,TOLAK',
            'catatan' => 'nullable|string',
            'alasan'  => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'peserta.required' => 'ID peserta wajib diisi.',
            'peserta.uuid'     => 'Format ID peserta harus berupa UUID.',
            'peserta.exists'   => 'Peserta dengan ID tersebut tidak ditemukan.',
            'status.required'  => 'Status verifikasi wajib diisi.',
            'status.in'        => 'Status harus berupa TERIMA atau TOLAK.',
        ];
    }
}
