<?php

namespace App\Http\Requests\Pengguna;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdateFotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('pengguna')->check();
    }

    public function rules(): array
    {
        return [
            'foto_profil' => 'nullable|image|max:2048|mimes:jpg,jpeg,png|mimetypes:image/jpeg,image/png',
        ];
    }

    public function attributes(): array
    {
        return [
            'foto_profil' => 'Foto Profil',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()->with('error', 'Validasi gagal')
        );
    }

    public function messages(): array
    {
        return [
            'foto_profil.image' => 'Field :attribute harus berupa gambar.',
            'foto_profil.max' => 'Field :attribute maksimal :max KB.',
            'foto_profil.mimes' => 'Field :attribute harus bertipe: jpg, jpeg, png.',
            'foto_profil.mimetypes' => 'Field :attribute harus bertipe: image/jpeg, image/png.',
        ];
    }
}
