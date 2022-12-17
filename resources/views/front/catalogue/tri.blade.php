@extends("front.layouts.app")

@section("title")
    Panier
@endsection

@section("content")
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">Accueil</a></li>
                    <li class="item-link"><span>Panier</span></li>
                </ul>
            </div>
            <div class=" main-content-area">

                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Article</h3>
                    <ul class="products-cart">
                        @foreach ($articles as $article)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('images/'.$article->ImageArticle) }}" alt=""></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product"
                                        href="{{ route('articles.show', $article->id) }}">{{ $article->LibelleArticle }}</a>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{ $article->PrixArticle }} FCFA</p>
                                </div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{-- $article->pivot->quantite --}}" data-max="120" pattern="[0-9]*" readonly>
                                        <a class="btn btn-increase" href="{{ route('panier.ajouter-article', ["article" => $article->id, "qte" => 1]) }}">
                                        </a>
                                        <a class="btn btn-reduce" href="{{ route('panier.retirer-article', ["article" => $article->id, "qte" => 1]) }}"></a>
                                    </div>
                                </div>
                                <div class="price-field sub-total">
                                    <p class="price">
                                        {{-- $article->pivot->prix_unitaire * $article->pivot->quantite --}} FCFA</p>
                                </div>
                                <div class="delete">
                                    <a href="{{ route('panier.retirer-article', $article->id) }}"
                                        class="btn btn-delete" title="">
                                        <span>Retirer du panier</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="summary">
                    <div class="order-summary">
                        <h4 class="title-box">Résumé</h4>
                        <p class="summary-info"><span class="title">Sous-total</span><b
                                class="index">{{-- $panier->total --}} FCFA</b></p>
                        <p class="summary-info"><span class="title">Livraison</span><b
                                class="index">Livraison gratuite</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b
                                class="index">{{-- $panier->total --}} FCFA</b></p>
                    </div>
                    <div class="checkout-info">
                        <label class="checkbox-field">
                            <input class="frm-input " name="have-code" id="have-code" value=""
                                type="checkbox"><span>J'ai un code promo</span>
                        </label>
                        <a class="btn btn-checkout" href="{{ route("commandes.create") }}">Passer ma commande</a>
                        <a class="link-to-shop" href="{{ url("/") }}">Continuer mes achats<i
                                class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>
                    <div class="update-clear">
                        <a class="btn btn-clear" href="{{ route("panier.vider") }}">Vider mon panier</a>
                        <a class="btn btn-update" href="{{ url()->current() }}">Actualiser mon panier</a>
                    </div>
                </div>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
