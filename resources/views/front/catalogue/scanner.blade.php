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

                    {{--<div class="wrap-pagination-info">
                        <ul class="page-numbers">
                            <li><span class="page-number-item current">1</span></li>
                            <li><a class="page-number-item" href="#">2</a></li>
                            <li><a class="page-number-item" href="#">3</a></li>
                            <li><a class="page-number-item next-link" href="#">Suivant</a></li>
                        </ul>
                        <p class="result-count">Montrer 1-8 of 12 résultat</p>
                    </div> --}}
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
                                        {{--@if ($categorie->sous_types->isNotEmpty()) --}}

                                            <ul class="sub-cate">
                                               {{-- @foreach ($categorie->sous_types as $sous_categorie) --}}
                                                    <li class="category-item">
                                                        {{ $piece }}
                                                       {{-- <a href="{{ route('catArts.show', $sous_categorie) }}"
                                                            class="cate-link">{{ $sous_categorie->LibCategorieArt }}
                                                            ({{  $sous_categorie->articles->count() }})
                                                        </a> --}}
                                                    </li>
                                                {{--@endforeach --}}
                                            </ul>
                                        {{--@endif --}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- Categories widget-->

                    <!-- Price-->

                    {{--<div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">La liste de fourniture scanner</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list has-count-index">
                                @foreach ($pieces as $pieces )
                                    <li class="list-item">
                                        <a class="filter-link " href="{{ route('cp1')}}">
                                            {{$piece}}
                                            <span>(217)</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div> --}}
                    <!-- Color -->
                    <!-- brand widget-->

                </div>
                <!--end sitebar-->
            </div>
            <!--end row-->

        </div>

        <!--end container-->


    </main>
    <!--main area-->
@endsection
