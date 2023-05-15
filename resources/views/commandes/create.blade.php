@extends("front.layouts.app")
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
                    <li class="item-link"><span>Commande</span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('commandes.store') }}" method="post" name="frm-billing">
                    <div class="wrap-address-billing">
                        <h3 class="box-title">Adresse de Facturation</h3>
                        @csrf
                        <input id="prenom" type="text" name="prenoms" value="{{ Session::get('client')->prenom }}" required class="hidden" />
                        <input id="nom" type="text" name="nom" value="{{ Session::get('client')->nom }}" required class="hidden" />
                        <input id="user_id" type="text" name="user_id" value="{{ Session::get('client')->id }}" required class="hidden" />
                        <input id="total" type="text" name="total" value="{{ $panier->total }}" required class="hidden" />

                        <p class="row-in-form">
                            <label for="phone">Numéro de téléphone<span>*</span></label>
                            <input id="phone" type="text" name="telephone" value="{{ old('telephone') }}"
                                placeholder="00 00 00 00 00/00 00 00 00 00" required>
                        </p>

                        <p class="row-in-form">
                            <label for="city">Ville<span>*</span></label>
                            <input id="city" type="text" name="ville" value="{{ old('ville') }}" required>
                        </p>
                        <p class="row-in-form">
                            <label for="email">E-mail:</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}">
                        </p>
                        <p class="row-in-form">
                            <label for="city2">Commune</label>
                            <input id="city2" type="text" name="commune" value="{{ old('commune') }}" />
                        </p>
                        <p class="row-in-form">
                            <label for="zip-code">Quartier</label>
                            <input id="zip-code" type="text" name="quartier" value="{{ old('quartier') }}" />
                        </p>
                    </div>
                    <div class="summary summary-checkout">
                        <div class="summary-item payment-method">
                            <h4 class="title-box">Moyen de paiement</h4>
                            <p class="summary-info"><span class="title">Argent comptant</span></p>
                            {{-- <div class="choose-payment-methods">
                                <label class="payment-method">
                                    <input name="payment-method" id="payment-method-bank" value="banque" type="radio">
                                    <span>Transfert bancaire</span>
                                    <span class="payment-desc">But the majority have suffered alteration in some form, by
                                        injected humour, or randomised words which don't look even slightly
                                        believable</span>
                                </label>
                                <label class="payment-method">
                                    <input name="payment-method" id="payment-method-visa" value="visa" type="radio">
                                    <span>visa</span>
                                    <span class="payment-desc">There are many variations of passages of Lorem Ipsum
                                        available</span>
                                </label>
                                <label class="payment-method">
                                    <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
                                    <span>Paypal</span>
                                    <span class="payment-desc">You can pay with your credit</span>
                                    <span class="payment-desc">card if you don't have a paypal account</span>
                                </label>
                            </div> --}}
                            <p class="summary-info grand-total"><span>Grand Total</span> <span
                                    class="grand-total-price">{{ $panier->total }} FCFA</span></p>
                            <button type="submit" class="btn btn-medium">Valider ma commande</button>
                        </div>
                        <form>
                            <div class="summary-item shipping-method">
                                <h4 class="title-box f-title">Librairie David</h4>
                                {{-- <p class="summary-info"><span class="title">Coût fixe</span></p>
                                <p class="summary-info"><span class="title">Frais 0.0 FCFA</span></p>
                                <h4 class="title-box">Code Promo</h4>
                                <p class="row-in-form">
                                    <label for="coupon-code">Entrez votre code promo :</label>
                                    <input id="coupon-code" type="text" name="coupon-code" value="" placeholder="Facultatif">
                                </p>
                                <a href="#" class="btn btn-small">Appliquer</a> --}}
                            </div>
                        </form>
                    </div>

                </form>
            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
