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
                    <div class="wrap-shop-control" style="margin-top: -9%">
                        <div class="container pb-60">
                            <div class="row">
                                <div style="margin-left: 12%">
                                    <h3><strong> Scanner votre liste de fourniture</strong></h3>
                                        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                                            @csrf
                                            <input type="file" name="image" class="form-control mb-2 mr-sm-2">
                                            <div class="input-group mb-2 mr-sm-2">
                                              <input type="text" name="classe" class="form-control mb-2 mr-sm-2" placeholder="Entrez la classe">
                                            </div>
                                            <button type="submit" class="btn btn-primary mb-2">Valider</button>
                                          </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end wrap shop control-->

                    <div class="wrap-shop-control">

                        <h1 class="shop-title">La liste des livres disponibles</h1>
                    </div>

                    <div class="row">

                        <ul class="product-list grid-products equal-container">
                            @foreach ($articles as $article)
                                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 " >
                                    <div class="product product-style-3 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('kits.show', $article->id) }}"
                                                title="{{ $article->LibelleKit }}">
                                                <figure>
                                                    <img src="/images/{{ $article->ImageKit }}"
                                                        alt="{{ $article->LibelleKit }}">
                                                    </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('kits.show', $article->id) }}"
                                                class="product-name"><span>{{ $article->LibelleKit }}</span></a>
                                            <div class="wrap-price"><span
                                                    class="product-price">{{ $article->PrixKit }} FCFA</span>
                                            </div>
                                            <a href="{{ route('panier.ajouter-kit', $article->id) }}"
                                                class="btn add-to-cart">Ajouter au panier</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>

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
