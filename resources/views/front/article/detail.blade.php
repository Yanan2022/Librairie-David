@extends("front.layouts.app")

@section('title')
    Detail Article
@endsection

@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{-- route('commandes.index') --}}" class="link">Article</a>
                    </li>
                    <li class="item-link"><span>Détail </span></li>
                </ul>
            </div>
            <div class=" main-content-area">

                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Articles</h3>
                    <ul class="products-cart">
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{--  asset('images/' . $article->ImageArticle) --}}" alt=""></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product"
                                        href="{{-- route('articles.show', $article) --}}">{{--  $article->LibelleArticle --}}</a>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{-- $article->pivot->prix_unitaire --}} FCFA</p>
                                </div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{-- $article->pivot->quantite --}}"
                                            data-max="120" pattern="[0-9]*" readonly>
                                        {{-- <a class="btn btn-increase" href="{{ route('panier.ajouter-article', ["article" => $article->id, "qte" => 1]) }}"></a>
                                        <a class="btn btn-reduce" href="{{ route('panier.retirer-article', ["article" => $article->id, "qte" => 1]) }}"></a> --}}
                                    </div>
                                </div>
                                <div class="price-field sub-total">
                                    <p class="price">
                                        {{-- $article->pivot->prix_unitaire * $article->pivot->quantite --}} FCFA</p>
                                </div>
                                {{-- <div class="delete">
                                    <a href="{{ route('panier.retirer-article', $article->id) }}"
                                        class="btn btn-delete" title="">
                                        <span>Retirer du panier</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div> --}}
                            </li>
                    </ul>
                </div>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->
    </main>
    <!--main area-->

@section('scripts')

@endsection
@endsection
