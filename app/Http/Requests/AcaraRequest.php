<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcaraRequest extends FormRequest
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
            'nama_acara' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'foto' => 'nullable|image|max:10240',
        ];
    }
}
