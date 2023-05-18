<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\EntrepriseModel;
use App\Models\Panier;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Session;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("front.commande.invoice");
    }

    public function voir_pdf($id){
        //return $id;
        Session::put('id', $id);
        try{
            $pdf = \App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
            $pdf->loadHTML($this->convert_orders_data_to_html());

            return $pdf->stream();
        }
        catch(\Exception $e){
            return redirect('/commandes')->with('error', $e->getMessage());
        }
    }

    public function convert_orders_data_to_html(){

        return $orders = Commande::where('id',Session::get('id'))->get();
        foreach($orders as $order){
            $name = $order->nom;
            $prenom = $order->prenoms;
            $address = $order->telephone;
            $ville = $order->ville;
            $date = $order->created_at;
        }

        // foreach($order->articles as $item){
        //     $LibelleArticle = $item->pivot->quantite;
        // }

        // return $LibelleArticle;

        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);

            return $order;
        });

        $output = '<link rel="stylesheet" href="frontend/css/style.css">
                        <table>
                            <thead class="thead">
                                <tr class="text-left">
                                    <th>
                                    Nom Client : '.$name.'<br> Contact Client : '.$address.' <br> Date : '.$date.'
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <table>
                            <thead">
                                <tr style="background: #eee;border-bottom: 1px solid #ddd;
                                font-weight: bold;
                                text-align: center;">
                                    <th>Image Article</th>
                                    <th>Nom des articles</th>
                                    <th></th>
                                    <th>Prix</th>
                                    <th></th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach($orders as $order){
                                foreach($order->articles as $item){

                                    $output .= '<tr">
                                                    <td><img src="'.asset('images/'.$item->ImageArticle).'" alt="" style = "height: 80px; width: 80px;"></td>
                                                    <td class="product-name">
                                                        <h3>'.$item['LibelleArticle'].'</h3>
                                                    </td>
                                                    <td> </td>
                                                    <td> '.$item->pivot->prix_unitaire.' fcfa</td>
                                                    <td></td>
                                                    <td class="qty">'.$item->pivot->quantite.'</td>
                                                    <td class="total">'.$item->pivot->prix_unitaire*$item->pivot->quantite.' fcfa</td>
                                                </tr><!-- END TR-->
                                                </tbody>';

                                }

                                $totalPrice = $order->total;

                            }

                        $output .='</table>';

                        $output .='<table class="table">
                                        <thead class="thead">
                                            <tr class="text-center">
                                                    <th>Total</th>
                                                    <th>'.$totalPrice.' fcfa</th>
                                            </tr>
                                        </thead>
                                    </table>';


                        return $output;



    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommandeRequest  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        return view("commandes.show", compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommandeRequest  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();

        return redirect()->route("commandes.index");
    }






}
