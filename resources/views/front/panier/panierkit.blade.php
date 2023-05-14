@extends("front.layouts.app")

@section("title")
    Panier kit
@endsection

@section("content")
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">Accueil</a></li>
                    <li class="item-link"><span>Panier kit</span></li>
                </ul>
            </div>
            <div class=" main-content-area">

                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Kit scolaire</h3>
                    <ul class="products-cart">
                        @foreach ($panier->kits as $article)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('images/'.$article->ImageKitscolaire) }}" alt=""></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product"
                                        href="{{ route('articles.show', $article) }}">{{ $article->LibelleKitscolaire }}</a>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{ $article->pivot->prix_unitaire }} FCFA</p>
                                </div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{ $article->pivot->quantite }}" data-max="120" pattern="[0-9]*" readonly>
                                        <a href="{{ route('panier.retirer-kit', ["kitscolaire" => $article->id, "qte" => 1]) }}">
                                            <img src="{{ asset('boutons/moins.png') }}" alt="moins">
                                        </a>
                                        <a href="{{ route('panier.ajouter-kit', ["kitscolaire" => $article->id, "qte" => 1]) }}">
                                            <img src="{{ asset('boutons/plus.png') }}" alt="plus">
                                        </a>
                                    </div>
                                </div>
                                <div class="price-field sub-total">
                                    <p class="price">
                                        {{ $article->pivot->prix_unitaire * $article->pivot->quantite }} FCFA</p>
                                </div>
                                <div class="delete">
                                    <a href="{{ route('panier.retirer-kit', $article->id) }}"
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
                                class="index">{{ $panier->total }} FCFA</b></p>
                        <p class="summary-info"><span class="title">Livraison</span><b
                                class="index">Livraison gratuite</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b
                                class="index">{{ $panier->total }} FCFA</b></p>
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

                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Les produits les plus vus</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                            data-loop="false" data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                            @foreach ($produits as $item )
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure>
                                            <img src="/images/{{ $item->ImageArticle }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">Nouveaux</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="{{ route('articles.show', $item->id) }}" class="function-link">Vue</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('panier.ajouter-article', $item->id) }}" class="product-name">
                                        <span>
                                            {{ $item->LibelleArticle }}
                                        </span>
                                    </a>
                                    <div class="wrap-price">
                                        <span class="product-price">{{ $item->PrixArticle }} FCFA</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
