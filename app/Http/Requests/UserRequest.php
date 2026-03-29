<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'nik' => 'required|string|unique:users,nik|max:255',
            'kantor_id' => 'required|exists:kantors,id',
            'departemen_id' => 'required|exists:departemens,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5|confirmed',
            'status_akun' => 'required|boolean',
        ];
    }
}
