<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class StorePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Route::has('login')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "author" => "required|between:3,20",
            "title" => "required",
            "excerpt" => "nullable|max:64",
            "content" => "required",
            "thumbnail" => "image|nullable|max:1999",
            "status" => "required"
        ];
    }

    public function messages()
    {
        return [
            "author.required" => "Nama author belum diisi",
            "author.between" => "Nama author tidak boleh kurang dari 3 dan lebih dari 20",
            "title.required" => "Title tidak boleh kosong",
            "excerpt.max" => "Excerpt tidak boleh lebih dari 64 karakter",
            "content.required" => "Konten tidak boleh kosong",
            "thumbnail.image" => "File dikirim harus gambar",
            "thumbnail.max" => "File Terlalu besar",
            "status.required" => "Status post masih kosong "
        ];
    }
}
