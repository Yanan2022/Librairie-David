<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivraisonRequest extends FormRequest
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
            'nomclient' => "required|string",
            'prenomclient' => "required|string",
            'contactclient' => "required|string",
            'long' => "required|string",
            'lat' => "required|string",
            'long_Arrive' => "required|string",
            'lat_Arrive' => "required|string",
            'idcolis' => "required|string",
            'description_colis' => "required|string",
            'coutLivraison' => "required|string",
            'imagecolis' => "sometimes|image",
            'idEntreprise' => "nullable|integer",
            'idArticle' => "nullable|integer",
        ];
    }
}
