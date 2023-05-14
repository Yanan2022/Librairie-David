@extends("front.layouts.app")

@section('title')
    Detail kit
@endsection

@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{-- route('commandes.index') --}}" class="link">Kit</a>
                    </li>
                    <li class="item-link"><span>Détail du kit </span></li>
                </ul>
            </div>
            <div class=" main-content-area">

                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Detail kit</h3>
                    <ul class="products-cart">
                        @foreach ($detailkitscolaires as $kitscolaire )
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure>
                                        <img src="{{  asset('images/' . $kitscolaire->ImageArticle) }}" alt="">
                                    </figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product"
                                        href="{{-- route('panier.ajouter-kit', $kitscolaire->id) --}}">{{  $kitscolaire->LibelleArticle }}</a>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{ $kitscolaire->PrixArticle }} FCFA</p>
                                </div>
                            </li>
                        @endforeach
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
