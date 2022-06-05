<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'artist_category_id' => 'required',
            'image' => 'file|mimes:jpg,jpeg,png|max:5120|nullable',
            'description' => 'sometimes',
            'nationality' => 'sometimes',
            'date_of_birth' => 'sometimes',
        ];
    }
}
