@extends("front.layouts.app")

@section('title')
    Commande #{{ $commande->id }}
@endsection

@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('commandes.index') }}" class="link">Commandes</a>
                    </li>
                    <li class="item-link"><span>Commande #{{ $commande->id }}</span></li>
                </ul>
            </div>
            <div class=" main-content-area">

                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Articles</h3>
                    <ul class="products-cart">
                        @foreach ($commande->articles as $article)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('images/' . $article->ImageArticle) }}" alt=""></figure>
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
                                        <input type="text" name="product-quatity" value="{{ $article->pivot->quantite }}"
                                            data-max="120" pattern="[0-9]*" readonly>
                                        {{-- <a class="btn btn-increase" href="{{ route('panier.ajouter-article', ["article" => $article->id, "qte" => 1]) }}"></a>
                                        <a class="btn btn-reduce" href="{{ route('panier.retirer-article', ["article" => $article->id, "qte" => 1]) }}"></a> --}}
                                    </div>
                                </div>
                                <div class="price-field sub-total">
                                    <p class="price">
                                        {{ $article->pivot->prix_unitaire * $article->pivot->quantite }} FCFA</p>
                                </div>
                                {{-- <div class="delete">
                                    <a href="{{ route('panier.retirer-article', $article->id) }}"
                                        class="btn btn-delete" title="">
                                        <span>Retirer du panier</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div> --}}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="wrap-address-billing">
                    <h3 class="box-title">Détails du client</h3>
                    @csrf
                    <p class="row-in-form">
                        <label for="fname">Prénom(s)</label>
                        <input id="fname" type="text" name="prenoms" value="{{ $commande->prenoms }}" disabled />
                    </p>
                    <p class="row-in-form">
                        <label for="lname">Nom</label>
                        <input id="lname" type="text" name="nom" value="{{ $commande->nom }}" disabled />
                    </p>
                    {{-- <p class="row-in-form">
                        <label for="email">Adresse E-mail:</label>
                        <input id="email" type="email" name="email" value="{{ $commande->email }}" disabled>
                    </p> --}}
                    <p class="row-in-form">
                        <label for="phone">Numéro de téléphone</label>
                        <input id="phone" type="text" name="telephone" value="{{ $commande->telephone }}"
                            placeholder="Au format 10 chiffres" disabled>
                    </p>
                    {{-- <p class="row-in-form">
                        <label for="add">Adresse</label>
                        <input id="add" type="text" name="adresse" value="{{ $commande->adresse }}" disabled />
                    </p> --}}
                    <p class="row-in-form">
                        <label for="city">Ville</label>
                        <input id="city" type="text" name="ville" value="{{ $commande->ville }}" disabled>
                    </p>
                    <p class="row-in-form">
                        <label for="city2">Commune</label>
                        <input id="city2" type="text" name="commune" value="{{ $commande->commune }}" disabled />
                    </p>
                    <p class="row-in-form">
                        <label for="zip-code">Quartier</label>
                        <input id="zip-code" type="text" name="quartier" value="{{ $commande->quartier }}" disabled />
                    </p>
                </div>

                <div class="summary">
                    <div class="order-summary">
                        <h4 class="title-box">Résumé</h4>
                        <p class="summary-info"><span class="title">Sous-total</span><b
                                class="index">{{ $commande->total }} FCFA</b></p>
                        <p class="summary-info"><span class="title">Livraison</span><b
                                class="index">Librairie David</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b
                                class="index">{{ $commande->total }} FCFA</b></p>
                    </div>
                    @if ($commande->etat == 'Soumis')
                        <div class="checkout-info">
                            <a data-commande='@json($commande)' class="btn btn-checkout valider-commande"
                                href="{{ route('commandes.validate', $commande) }}">Valider la commande</a>
                        </div>
                    @endif
                </div>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->
    </main>
    <!--main area-->

@section('scripts')
    <script>
        $(".valider-commande").click(function(e) {
                e.preventDefault();
                var commande = $(this).data("commande");
                $.post('{{ route('commandes.validate', '__id__') }}'.replaceAll('__id__', commande.id), {
                    commande_id: commande.id,
                    _token: '{{ csrf_token() }}',
                }).done(function(res) {
                    try {
                        $.notify({
                            icon: 'la la-check',
                            title: 'Information',
                            message: 'La commande a bien été validée !',
                        }, {
                            type: 'success',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            time: 3000,
                        });
                    } catch (ex) {
                        console.warn(ex.message);
                    }
                    window.location = res.redirect;
                }).fail(function(err) {
                    try {
                        $.notify({
                        icon: 'la la-times',
                        title: 'Erreur',
                        message: err.responseJSON?.message,
                    }, {
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        time: 3000,
                    });
                    } catch (ex) {
                        console.warn(ex.message);
                    }

                })
            })
    </script>
@endsection
@endsection
