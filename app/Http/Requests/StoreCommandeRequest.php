<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommandeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "uuid" => "sometimes|required|string|max:250",
            "nom" => "required|string|max:160",
            "prenoms" => "required|string|max:160",
            "telephone" => "required|string|max:160",
            "email" => "required|string|email|max:64",
            "ville" => "required|string|max:160",
            "commune" => "required|string|max:160",
            "quartier" => "nullable|string|max:160",
            "user_id" => "required",
            //"adresse" => "required|string|max:250",
            "coordonnees" => "sometimes|array|size:2",
        ];
    }
}
