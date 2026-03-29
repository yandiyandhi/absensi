<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IzinRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'kantor_id' => 'required|exists:kantors,id',
            'jenis_izin_id' => 'required|exists:jenis_izins,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'alasan' => 'required|string|max:255',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:10240'
        ];
    }
}
