@extends("front.layouts.app")

@section("title")
    Liste des  commandes
@endsection

@section("content")
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">Accueil</a></li>
                    <li class="item-link"><span>Commandes</span></li>
                </ul>
            </div>
            <div class=" main-content-area">

                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Liste des commandes</h3>
                    <ul class="products-cart">
                        <li class="pr-cart-item">
                            <div class="product-name">
                                <p class="price">
                                    <strong>Date</strong>
                                </p>
                            </div>

                            <div class="price-field produtc-price">
                                <p class="price">
                                    Telephone
                                </p>
                            </div>
                            <div class="price-field produtc-price">
                                <p class="price">
                                    Email
                                </p>
                            </div>
                            <div class="price-field produtc-price">
                                <p class="price">
                                    Etat
                                </p>
                            </div>
                            <div class="price-field sub-total">
                                <p class="price">
                                    Ville
                                </p>
                            </div>
                            <div class="price-field sub-total">
                                <p class="price">
                                    Détail
                                </p>
                            </div>
                        </li>
                        @foreach ($listeCommandes as $listeCommande)
                            <li class="pr-cart-item">
                                <div class="product-name">
                                    <a class="link-to-product" href="{{ route('articles.show', $listeCommande->id) }}">
                                        {{ $listeCommande->created_at->isoFormat('DD MMM Y, HH:mm') }}
                                    </a>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{ $listeCommande->telephone }} </p>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{ $listeCommande->email }} </p>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{ $listeCommande->etat }} </p>
                                </div>
                                <div class="price-field sub-total">
                                    <p class="price">
                                        {{ $listeCommande->ville }}
                                    </p>
                                </div>
                                <div class="price-field sub-total">
                                    <p class="price">
                                        <a class="btn-submit" href="{{ route('detailCommande', $listeCommande->id) }}">
                                            voir détail
                                        </a>
                                    </p>
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
@endsection
