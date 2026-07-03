<?php

namespace App\Http\Requests\Materi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SoalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kuis' => 'required|integer|exists:kuis,id_kuis',
            'teks_soal' => 'required|string',
            'gambar_soal' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp|mimetypes:image/jpeg,image/png,image/webp',
            'nilai' => 'required|integer|min:1',
            'penjelasan' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_kuis' => 'Kuis',
            'teks_soal' => 'Teks Soal',
            'gambar_soal' => 'Gambar Soal',
            'nilai' => 'Nilai',
            'penjelasan' => 'Penjelasan',
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
            'integer' => 'Field :attribute harus berupa angka.',
            'min' => 'Field :attribute minimal :min.',
            'exists' => 'Field :attribute tidak ditemukan.',

            'gambar_soal.image' => 'Field :attribute harus berupa gambar.',
            'gambar_soal.max' => 'Field :attribute maksimal :max KB.',
            'gambar_soal.mimes' => 'Field :attribute harus bertipe: jpg, jpeg, png, atau webp.',
            'gambar_soal.mimetypes' => 'Field :attribute harus bertipe: image/jpeg, image/png, atau image/webp.',
        ];
    }
}