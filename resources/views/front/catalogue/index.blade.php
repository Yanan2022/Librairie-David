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
                    <div class="wrap-shop-control" style="margin-top: -9%; margin-left: '20px' ">
                        <div class="container">
                            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" class="form-inline" name="frm-billing">
                                <div class="wrap-address-billing">
                                    <h3 style="margin-left: 250px;" class="box-title">Scannez votre liste de fourniture</h3>
                                    @csrf
                                    <div style="display: flex !important;align-items: center;justify-content: space-around;margin-left: 150px;">
                                        <p class="row-in-form">
                                            <label for="phone">Image de la liste de fourniture<span>*</span></label>
                                            <input id="phone" type="file" name="image" value="{{ old('telephone') }}" required>
                                        </p>
                                        <p class="row-in-form">
                                            <label for="city">La classe<span>*</span></label>
                                            <select name="classe" style="width:100%">
                                                <option>Selectionnez la classe</option>
                                                @foreach ($classes as $classe )
                                                    <option id="city" value="{{ $classe->libelle }}">{{ $classe->libelle }}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="summary-item payment-method" style="margin-left: 250px;">
                                        <button type="submit" class="btn btn-medium">Valider ma reconnaissance</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="banner-shop" style="margin-top: 2%">
                        <div class="wrap-show-advance-info-box style-1 box-in-site">
                            <h3 class="title-box">Les catégories de kits (Selectionner une catégorie)</h3>
                            <div class="wrap-products">
                                <div class="row">
                                    <ul class="product-list grid-products equal-container">                          
                                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 " >
                                                <div class="product product-style-3 equal-elem ">
                                                    <div class="product-thumnail">
                                                        <a href="{{route('kits.index')}}"
                                                            title="{{-- $article->LibelleArticle --}}">
                                                            <figure>
                                                                <img src="assets/images/products/kit-standard.PNG" width="250" height="214"
                                                        alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                                                </figure>
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="{{-- route('articles.show', $article) --}}"
                                                            class="product-name"><span>{{-- $article->LibelleArticle --}}</span></a>
                                                        <div class="wrap-price"><span
                                                                class="product-price">KIT STANDARD</span>
                                                        </div>
                                                        <a href="{{route('kits.index')}}"
                                                            class="btn add-to-cart">KIT STANDARD</a>
                                                    </div>
                                                </div>
                                            </li> 
                                            
                                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 " >
                                                <div class="product product-style-3 equal-elem ">
                                                    <div class="product-thumnail">
                                                        <a href="{{-- route('articles.show', $article) --}}"
                                                            title="{{-- $article->LibelleArticle --}}">
                                                            <figure>
                                                                <img src="assets/images/products/kit-ecole.jpg" width="250" height="214"
                                                        alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                                                </figure>
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="{{-- route('articles.show', $article) --}}"
                                                            class="product-name"><span>{{-- $article->LibelleArticle --}}</span></a>
                                                        <div class="wrap-price"><span
                                                                class="product-price">KIT ECOLE</span>
                                                        </div>
                                                        <a href="{{route('ecoles.index')}}"
                                                            class="btn add-to-cart">KIT ECOLE</a>
                                                    </div>
                                                </div>
                                            </li>  

                                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 " >
                                                <div class="product product-style-3 equal-elem ">
                                                    <div class="product-thumnail">
                                                        <a href="{{-- route('articles.show', $article) --}}"
                                                            title="{{-- $article->LibelleArticle --}}">
                                                            <figure>
                                                                <img src="assets/images/products/kit-autre.jpg" width="250" height="214"
                                                        alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                                                </figure>
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="{{-- route('articles.show', $article) --}}"
                                                            class="product-name"><span>{{-- $article->LibelleArticle --}}</span></a>
                                                        <div class="wrap-price"><span
                                                                class="product-price">AUTRE KIT</span>
                                                        </div>
                                                        <a href="{{-- route('panier.ajouter-article', $article->id) --}}"
                                                            class="btn add-to-cart">AUTRE KIT</a>
                                                    </div>
                                                </div>
                                            </li>  
                                    </ul>
                                </div>
                                {{-- <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                                    data-loop="false" data-nav="true" data-dots="false"
                                    data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>
        
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                                <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214"
                                                        alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item new-label">new</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="#" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker
                                                    [White]</span></a>
                                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                        </div>
                                    </div>
        
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                                <figure><img src="assets/images/products/digital_17.jpg" width="214" height="214"
                                                        alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item sale-label">sale</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="#" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker
                                                    [White]</span></a>
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
                                                <figure><img src="assets/images/products/digital_15.jpg" width="214" height="214"
                                                        alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item new-label">new</span>
                                                <span class="flash-item sale-label">sale</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="#" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker
                                                    [White]</span></a>
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
                                                <figure><img src="assets/images/products/digital_01.jpg" width="214" height="214"
                                                        alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item bestseller-label">Bestseller</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="#" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker
                                                    [White]</span></a>
                                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                        </div>
                                    </div>
        
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                                <figure><img src="assets/images/products/digital_21.jpg" width="214" height="214"
                                                        alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                            </a>
                                            <div class="wrap-btn">
                                                <a href="#" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker
                                                    [White]</span></a>
                                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <!--End wrap-products-->
                        </div>
                        
                    </div>



                    <!--end wrap shop control-->

                    <div class="row">

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
                </div>
                <!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget mercado-widget categories-widget">
                        <h2 class="widget-title">Toutes les Catégories</h2>
                        <div class="widget-content">
                            <ul class="list-category">
                                @foreach ($categories as $categorie)
                                    <li class="category-item has-child-cate">
                                        <a href="{{ route('detailCategories', $categorie) }}"
                                            class="cate-link">{{ $categorie->LibCategorieArt }}</a>
                                        @if ($categorie->sous_types->isNotEmpty())
                                            <span class="toggle-control">+</span>
                                            <ul class="sub-cate">
                                                @foreach ($categorie->sous_types as $sous_categorie)
                                                    <li class="category-item">
                                                        <a href="{{ route('detailCategories', $sous_categorie) }}"
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

                    <!-- Price-->

                    <div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">Toutes les Classes</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list has-count-index">
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('cp1')}}">
                                        PETITE SECTION (PS)
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('cp1')}}">
                                        MOYENNE SECTION (MS)
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('cp1')}}">
                                        GRANDE SECTION (GS)
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('cp1')}}">
                                        CP1
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('cp2')}}">
                                        CP2
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('ce1')}}">
                                        CE1
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('ce2')}}">
                                        CE2
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('cm1')}}">
                                        CM1
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('cm2')}}">
                                        CM2
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('sixieme')}}">
                                        Sixième(6ième)
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('cinquieme')}}">
                                        Cinquième(5ième)
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('quatrieme')}}">
                                        Quatrième(4ième)
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('troisieme')}}">
                                        Troisième(3ième)
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('seconde')}}">
                                        Second (2nd)
                                    </a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="{{ route('premiere')}}">
                                        Prémière (1ère)
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="filter-link " href="{{ route('terminal')}}">
                                        Terminale(Tle)
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Color -->
                    <!-- brand widget-->

                </div>
                <!--end sitebar-->
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Les kits scolaire</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                            data-loop="false" data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                            @foreach ($kitscolaires as $item )
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('panier.ajouter-kit', $item->id) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                            <figure>
                                                <img src="/images/{{ $item->ImageKitscolaire }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
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
                                        <a href="{{ route('panier.ajouter-kit', $item->id) }}" class="product-name">
                                            <span>
                                                {{ $item->LibelleKitscolaire }}
                                            </span>
                                        </a>
                                        <div class="wrap-price">
                                            <span class="product-price">{{ $item->PrixKitscolaire }} FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>

                <!--la liste des nouveaux produits -->
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Les nouveaux produits</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                            data-loop="false" data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                            @foreach ($produits as $item )
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a title="T-Shirt Raw Hem Organic Boro Constrast Denim">
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
                                            <span class="product-price">{{ $article->PrixArticle }} FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

    <script>
        save_btn = document.querySelector(".save-btn")

        save_btn.onclick = function(){
            this.innerHTML = "<div class='loader'></div>";
        }
    </script>
@endsection
