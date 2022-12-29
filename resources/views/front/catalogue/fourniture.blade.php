@extends("front.layouts.app")

@section("title")
    Librairie David
@endsection

@section('content')
    <!--main area-->
    <main id="main" class="main-site left-sidebar">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ url('/') }}" class="link">Accueil</a></li>
                    <li class="item-link"><span>Ouvrage</span></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                    <div class="wrap-shop-control">

                        <h1 class="shop-title">Ouvrage {{$articles["0"]->classe}}</h1>

                        <div class="wrap-right">
                            <div class="change-display-mode">
                                {{--<a href="{{ route('cp1')}}" class="grid-mode display-mode active">
                                    <i class="fa fa-th"></i>Grille</a>
                                <a href="list.html" class="list-mode display-mode">
                                    <i class="fa fa-th-list"></i>
                                    Liste
                                </a> --}}
                        </div>

                        </div>

                    </div>
                    <!--end wrap shop control-->

                    <div class="row">

                        <ul class="product-list grid-products equal-container">

                            @foreach ($articles as $article)
                                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 " >
                                    <div class="product product-style-3 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('articles.show', $article->id) }}"
                                                title="{{ $article->LibelleArticle }}">
                                                <figure>
                                                    <img src="/images/{{ $article->ImageArticle }}"
                                                        alt="{{ $article->LibelleArticle }}">
                                                    </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('articles.show', $article->id) }}"
                                                class="product-name"><span>{{ $article->LibelleArticle }}</span></a>
                                            <div class="wrap-price"><span
                                                    class="product-price">{{ $article->PrixArticle }} FCFA</span>
                                            </div>
                                            <a href="{{ route('panier.ajouter-article', $article->id) }}"
                                                class="btn add-to-cart">Ajouter au panier</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>

                    </div>
                    <div class="wrap-pagination-info">
                        <ul class="page-numbers">
                            <li><span class="page-number-item current">{{-- $articles->links() --}}</span></li>
                            {{--<li><a class="page-number-item" href="#">2</a></li>
                            <li><a class="page-number-item" href="#">3</a></li>
                            <li><a class="page-number-item next-link" href="#">Next</a></li> --}}
                        </ul>
                        {{--<p class="result-count">Showing 1-8 of 12 result</p> --}}
                    </div>
                </div>
                <!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget mercado-widget categories-widget">
                        <h2 class="widget-title">Toutes les Catégories</h2>
                        <div class="widget-content">
                            <ul class="list-category">
                                @foreach ($categories as $categorie)
                                    <li class="category-item has-child-cate">
                                        <a href="{{ route('catArts.show', $categorie) }}"
                                            class="cate-link">{{ $categorie->LibCategorieArt }}</a>
                                        @if ($categorie->sous_types->isNotEmpty())
                                            <span class="toggle-control">+</span>
                                            <ul class="sub-cate">
                                                @foreach ($categorie->sous_types as $sous_categorie)
                                                    <li class="category-item">
                                                        <a href="{{ route('catArts.show', $sous_categorie) }}"
                                                            class="cate-link">{{ $sous_categorie->LibCategorieArt }}
                                                            ({{ $sous_categorie->articles->count() }})
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- Categories widget-->

                    {{--<div class="widget mercado-widget filter-widget brand-widget">
                        <h2 class="widget-title">Marques</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list list-limited" data-show="6">
                                @foreach ($entreprises as $key => $marque)
                                    <li class="list-item">
                                        <a class="filter-link active"
                                            href="{{ route('entreprises.show', $marque) }}">{{ $marque->LibelleEntreprise }}</a>
                                    </li>
                                @endforeach
                                <li class="list-item"><a
                                        data-label='Afficher moins<i class="fa fa-angle-up" aria-hidden="true"></i>'
                                        class="btn-control control-show-more" href="#">Afficher plus <i
                                            class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div> --}}<!-- brand widget-->

                    {{--<div class="widget mercado-widget filter-widget price-filter">
                        <h2 class="widget-title">Prix</h2>
                        <div class="widget-content">
                            <div id="slider-range"></div>
                            <p>
                                <label for="amount">Prix:</label>
                                <input type="text" id="amount" readonly>
                                <button class="filter-submit">Filtrer</button>
                            </p>
                        </div>
                    </div>  --}}<!-- Price-->

                    <div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">Classe</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list has-count-index">
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('cp1')}}">
                                        CP1
                                        <span>(217)</span></a>
                                    </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('cp2')}}">
                                    CP2
                                        <span>(179)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="{{ route('ce1')}}">CE1
                                        <span>(79)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="{{ route('ce2')}}">CE2
                                        <span>(283)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="{{ route('cm1')}}">CM1
                                        <span>(116)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="{{ route('cm2')}}">CM2
                                        <span>(29)</span></a></li>
                            </ul>
                        </div>
                    </div><!-- Color -->

                </div>
                <!--end sitebar-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
