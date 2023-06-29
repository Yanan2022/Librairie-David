@extends("layouts")
@section('title')
    Nouvelle commande
@endsection 
@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">Accueil</a></li>
                    <li class="item-link"><a href="{{ route('commandes.index') }}" class="link">Commandes</a>
                    </li>
                    <li class="item-link"><span>Commande #{{ $commande->id }}</span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                <form action="{{ route('commandes.choose-delivery-mode', $commande) }}" method="post" name="frm-billing">
                    @csrf
                    <div class="summary summary-checkout">
                        <div class="summary-item payment-method">
                            <h4 class="title-box">Mode de Livraison</h4>
                            <p class="summary-info"><span
                                    class="title">{{ $types_vehicules->first()->nom }} (par
                                    défaut)</span></p>
                            <div class="choose-payment-methods">
                                @foreach ($types_vehicules as $key => $type)
                                    <label class="payment-method">
                                        <input name="type_vehicule_id" id="payment-method-bank{{ $type->id }}" value="{{ $type->id }}" type="radio" @if(!$key) checked @endif>
                                        <span>{{ $type->nom }}</span>
                                        {{-- <span class="payment-desc">But the majority have suffered alteration in some form,
                                            by
                                            injected humour, or randomised words which don't look even slightly
                                            believable</span> --}}
                                    </label>
                                @endforeach
                            </div>
                            <p class="summary-info grand-total"><span>Grand Total</span> <span
                                    class="grand-total-price">{{ $commande->total }} FCFA</span></p>
                            <input type="hidden" name="commande_id" value="{{ $commande->id }}" />
                            <button type="submit" class="btn btn-medium">Soumettre</button>
                        </div>
                        <div class="summary-item shipping-method">
                            <h4 class="title-box f-title">Livraison</h4>
                            <p class="summary-info"><span class="title">Coût fixe</span></p>
                            <p class="summary-info"><span class="title">Frais 0.0 FCFA</span></p>
                            {{-- <h4 class="title-box">Code Promo</h4>
                            <p class="row-in-form">
                                <label for="coupon-code">Entrez votre code promo :</label>
                                <input id="coupon-code" type="text" name="coupon-code" value="" placeholder="Facultatif">
                            </p>
                            <a href="#" class="btn btn-small">Appliquer</a> --}}
                        </div>
                    </div>

                </form>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
