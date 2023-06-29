@extends("front.layouts.app")
@section('title')
    Annulée commande
@endsection
@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">Accueil</a></li>
                    <li class="item-link"><span>Motif</span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('storeCommentaire') }}" method="post" name="frm-billing">
                    <div class="wrap-address-billing">
                        <h3 class="box-title">Motif de l'annulation de la commande <span>*</span></h3>
                        @csrf


                        <div class="form-group">
                            <textarea style="width: 200%; heigth:200%" class="form-control form-control-textarea" id="description_colis" name="description">
                            </textarea>
                        </div>


                    </div>
                    <div class="summary summary-checkout">
                        <div class="summary-item payment-method">
                            <button type="submit" class="btn btn-medium">Valider le motif</button>
                        </div>

                    </div>

                </form>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
