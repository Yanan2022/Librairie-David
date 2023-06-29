@extends("front.layouts.app")

@section("title")
    Liste Fourniture
@endsection

@section('content')
    <!--main area-->
    <main id="main" class="main-site left-sidebar">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ url('/') }}" class="link">Accueil</a></li>
                    <li class="item-link"><span>Liste Fourniture</span></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                    <!--end wrap shop control-->
                    <div class="wrap-shop-control">
                        <h1 class="shop-title">La liste des articles disponibles</h1>
                    </div>
                    <div class=" main-content-area">
                        <div class="wrap-iten-in-cart">
                            <ul class="products-cart">
                                @foreach ($panier->articles as $article)
                                    <li class="pr-cart-item">
                                        <div class="product-image">
                                            <figure><img src="{{ asset('images/'.$article->ImageArticle) }}" alt=""></figure>
                                        </div>
                                        <div class="product-name">
                                            <a class="link-to-product"
                                                href="{{ route('articles.show', $article) }}">{{ $article->LibelleArticle }}</a>
                                        </div>
                                        <div class="price-field produtc-price">
                                            <p class="price">{{ $article->pivot->prix_unitaire }} FCFA</p>
                                        </div>
                                        <div class="quantity">
                                            <div class="quantity-input">
                                                <input type="text" name="product-quatity" value="{{ $article->pivot->quantite }}" data-max="120" pattern="[0-9]*" readonly>
                                                <a href="{{ route('panier.retirer-article', ["article" => $article->id, "qte" => 1]) }}">
                                                    <img src="{{ asset('boutons/moins.png') }}" alt="moins">
                                                </a>
                                                <a href="{{ route('panier.ajouter-article', ["article" => $article->id, "qte" => 1]) }}">
                                                    <img src="{{ asset('boutons/plus.png') }}" alt="plus">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="price-field sub-total">
                                            <p class="price">
                                                {{ $article->pivot->prix_unitaire * $article->pivot->quantite }} FCFA</p>
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
                                        class="index">{{ $panier->total }} FCFA</b></p>
                                        @if (request()->session()->has('coupon'))
                                        <p class="summary-info">
                                            <span class="title">
                                                Coupon
                                                {{ request()->session()->get('coupon')['code'] }}
                                            </span>
                                            <b class="index">
                                                {{ request()->session()->get('coupon')['remise'] }} FCFA
                                            </b>
                                        </p>
                                        <p class="summary-info">
                                            <form action="{{ route('panier.destroy.coupon') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-small btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </p>
                                    @endif
                                <p class="summary-info total-info "><span class="title">Total</span><b
                                        class="index">{{ $panier->total }} FCFA</b></p>
                            </div>
                            <div class="checkout-info">
                                <label class="checkbox-field">
                                    <input class="frm-input " name="have-code" id="have-code" value=""
                                        type="checkbox"><span>J'ai un code promo</span>
                                </label>
                                @if (!request()->session()->has('coupon'))
                                <div class="summary-item">
                                    @if (Session::has('status'))
                                    <div class="alert alert-danger">
                                        {{Session::get('status')}}
                                    </div>
                                @endif
                                @if (count($errors)>0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error )
                                                <li>{{$errors}}<li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('panier.store.coupon') }}" method="POST">
                                    @csrf
                                    <h4 class="title-box">Coupon code</h4>
                                    <p class="row-in-form">
                                        <label for="coupon-code">Entrez votre code coupon:</label>
                                        <input type="text" name="code">
                                    </p>
                                    <button type="submit" class="btn btn-small">Appliquer</button>
                                </form>
                            </div>
                        @else
                            <p>Un coupon est deja appliqué</p>
                        @endif
                                <a class="btn btn-checkout" href="{{ route("commandes.create") }}">Passer ma commande</a>
                                <a class="link-to-shop" href="{{ url("/") }}">Continuer mes achats<i
                                        class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                            </div>
                            <div class="update-clear">
                                <a class="btn btn-clear" href="{{ route("panier.vider") }}">Vider mon panier</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end main products area-->
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget mercado-widget categories-widget">
                        <h2 class="widget-title">La liste de fournitures scannées </h2>
                        <div class="widget-content">
                            <ul class="list-category">
                                @foreach ($pieces as $piece)
                                    <li class="category-item has-child-cate">
                                        <a class="cate-link">{{ $piece }}</a>
                                            <ul class="sub-cate">
                                                    <li class="category-item">
                                                        {{ $piece }}
                                                    </li>
                                            </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- Categories widget-->
                </div>
                <!--end sitebar-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </main>
    <!--main area-->
@endsection
