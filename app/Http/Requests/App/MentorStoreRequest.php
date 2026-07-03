<?php

namespace App\Http\Requests\App;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MentorStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:191',
            'password' => 'required|string|min:8',
            'foto_profil' => 'nullable|image|max:2048|mimes:jpg,jpeg,png|mimetypes:image/jpeg,image/png',
            'bio' => 'nullable|string',
            'spesialisasi' => 'nullable|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
            'foto_profil' => 'Foto Profil',
            'bio' => 'Bio',
            'spesialisasi' => 'Spesialisasi',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()->messages(),
            ], 422)
        );
    }

    public function messages(): array
    {
        return [
            'required' => 'Field :attribute wajib diisi.',
            'string' => 'Field :attribute harus berupa teks.',
            'max' => 'Field :attribute maksimal :max karakter.',
            'min' => 'Field :attribute minimal :min karakter.',
            'email' => 'Field :attribute harus berupa email yang valid.',
            'url' => 'Field :attribute harus berupa URL yang valid.',
            'unique' => 'Field :attribute sudah digunakan.',
            'foto_profil.image' => 'Field :attribute harus berupa gambar.',
            'foto_profil.max' => 'Field :attribute maksimal :max KB.',
            'foto_profil.mimes' => 'Field :attribute harus bertipe: jpg, jpeg, png.',
            'foto_profil.mimetypes' => 'Field :attribute harus bertipe: image/jpeg, image/png.',
        ];
    }
}
