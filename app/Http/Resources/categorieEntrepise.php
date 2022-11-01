<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class categorieEntrepise extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      //  return parent::toArray($request);
      return [
        'CodeEntreprise'=>$this->CodeEntreprise,
        'LibelleEntreprise'=>$this->LibelleEntreprise,
        'ContactEntreprise'=>$this->ContactEntreprise,
        'AdresseEntreprise'=>$this->AdresseEntreprise,
        'MailEntreprise'=>$this->MailEntreprise,
        'SiteEntreprise'=>$this->SiteEntreprise,
        'long'=>$this->long,
        'lat'=>$this->lat,
        'Id_Catégorie'=>$this->Id_Catégorie,
        'Id_pays'=>$this->Id_pays,
      ];

       
    }
}
