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
                    <li class="item-link"><span>Librairie</span></li>
                </ul>
            </div>
            <div class="row">

                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                    <div class="banner-shop" style="margin-top: -6%">
                        <a href="#" class="banner-link">
                            {{--<figure><img src="assets/images/shop-banner.jpg" alt=""></figure>  --}}
                            <figure><img src="{{ asset('shop-banner.jpg') }}" alt=""></figure>
                        </a>
                    </div>
                    <div class="row">
                        <div class="wrap-shop-control">

                            <h1 class="shop-title">Scanner votre liste de fourniture</h1><br>

                            <div class="wrap-right">

                                <div class="sort-item orderby ">
                                    <label for="validationDefault01">First name</label>
                                    <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Mark" required>
                                </div>

                                <div class="sort-item orderby ">
                                    <label for="validationDefault01">Photo</label>
                                    <input type="file" class="form-control" id="validationDefault01" placeholder="First name" value="Mark" required>
                                </div>

                                <div class="sort-item orderby ">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>



                            </div>

                        </div>
                    </div>
                    <!--end wrap shop control-->

                    {{--<div class="row">

                        <ul class="product-list grid-products equal-container">

                            @foreach ($articles as $article)
                                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 " >
                                    <div class="product product-style-3 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('articles.show', $article) }}"
                                                title="{{ $article->LibelleArticle }}">
                                                <figure>
                                                    <img src="/images/{{ $article->ImageArticle }}"
                                                        alt="{{ $article->LibelleArticle }}">
                                                    </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('articles.show', $article) }}"
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
                            <li><span class="page-number-item current">1</span></li>
                            <li><a class="page-number-item" href="#">2</a></li>
                            <li><a class="page-number-item" href="#">3</a></li>
                            <li><a class="page-number-item next-link" href="#">Suivant</a></li>
                        </ul>
                        <p class="result-count">Montrer 1-8 of 12 résultat</p>
                    </div>--}}
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

                    {{-- <div class="widget mercado-widget filter-widget price-filter">
                        <h2 class="widget-title">Prix</h2>
                        <div class="widget-content">
                            <div id="slider-range"></div>
                            <p>
                                <label for="amount">Prix:</label>
                                <input type="text" id="amount" readonly>
                                <button class="filter-submit">Filtrer</button>
                            </p>
                        </div>
                    </div> --}}<!-- Price-->

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
                                        <span>(179)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('ce1')}}">
                                    CE1
                                    <span>(79)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('ce2')}}">
                                    CE2
                                    <span>(283)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('cm1')}}">
                                    CM1
                                    <span>(116)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('cm2')}}">
                                    CM2
                                    <span>(29)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('6ieme')}}">
                                    6ième
                                    <span>(29)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('5ieme')}}">
                                    5ième
                                    <span>(29)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('4ieme')}}">
                                    4ième
                                    <span>(29)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('3ieme')}}">
                                    3ième
                                    <span>(29)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('2nd')}}">
                                    2nd
                                    <span>(29)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('1ere')}}">
                                    1ère
                                    <span>(29)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('tle')}}">
                                    Tle
                                    <span>(29)</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Color -->

                    {{--<div class="widget mercado-widget filter-widget">
                         <h2 class="widget-title">Size</h2>
                        <div class="widget-content">
                            <ul class="list-style inline-round ">
                                <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                                <li class="list-item"><a class="filter-link " href="#">M</a></li>
                                <li class="list-item"><a class="filter-link " href="#">l</a></li>
                                <li class="list-item"><a class="filter-link " href="#">xl</a></li>
                            </ul>
                            <div class="widget-banner">
                                <figure>
                                    <img src="{{ asset('catalogue/assets/images/size-banner-widget.jpg')}}" width="270" height="331"
                                        alt="">
                                    </figure>
                            </div>
                        </div>
                    </div>--}}<!-- Size -->

                    {{--<div class="widget mercado-widget widget-product">
                        <h2 class="widget-title">Articles populaires</h2>
                        <div class="widget-content">
                            <ul class="products">
                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                                title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="{{ asset('catalogue/assets/images/products/digital_01.jpg') }}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                                    Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                                title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="{{asset('catalogue/assets/images/products/digital_17.jpg')}}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                                    Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                                title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="{{asset('catalogue/assets/images/products/digital_18.jpg')}}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                                    Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                                title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="{{asset('catalogue/assets/images/products/digital_20.jpg')}}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                                    Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div> --}}
                    <!-- brand widget-->

                </div>
                <!--end sitebar-->
                <div class="wrap-show-advance-info-box style-1 box-in-site" style="background-color: white">
                    <h3 class="title-box">Les nouveaux produits</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                            data-loop="false" data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_04.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">Nouveaux</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">Vue</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_17.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">Vendre</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><ins>
                                            <p class="product-price">$168.00</p>
                                        </ins> <del>
                                            <p class="product-price">$250.00</p>
                                        </del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_15.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">Nouveau</span>
                                        <span class="flash-item sale-label">Vendre</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">J'achète</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><ins>
                                            <p class="product-price">$168.00</p>
                                        </ins> <del>
                                            <p class="product-price">$250.00</p>
                                        </del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_01.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item bestseller-label">Bestseller</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">Vue</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_21.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">Vue</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>

                <div class="wrap-show-advance-info-box style-1 box-in-site" style="background-color: white">
                    <h3 class="title-box">Offrez-vous un ordinateur pour la rentrée</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                            data-loop="false" data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_04.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">Nouveau</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">J'achète</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_17.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">Vendre</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">J'achète</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><ins>
                                            <p class="product-price">$168.00</p>
                                        </ins> <del>
                                            <p class="product-price">$250.00</p>
                                        </del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_15.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">J'achète</span>
                                        <span class="flash-item sale-label">Vendre</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">Vue</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><ins>
                                            <p class="product-price">$168.00</p>
                                        </ins> <del>
                                            <p class="product-price">$250.00</p>
                                        </del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_01.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item bestseller-label">Bestseller</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">Vue</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_21.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">Vue</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>

            </div>
            <!--end row-->

        </div>

        <!--end container-->


    </main>
    <!--main area-->
@endsection
