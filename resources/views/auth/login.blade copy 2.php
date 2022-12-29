@extends('front.layouts.app')

@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">Accueil</a></li>
                    <li class="item-link"><span>Connectez-vous à votre compte</span></li>
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
                <center>
                    <form action="{{ route('login') }}" method="post" name="frm-billing" class="summary summary-checkout">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Connectez-vous à votre compte</h3>
                            @csrf
                            <p class="row-in-form">
                                <label for="email">E-mail<span>*</span></label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required />
                            </p>
                            <p class="row-in-form">
                                <label for="lname">Mot de passe<span>*</span></label>
                                <input id="password" type="text" name="password" value="{{ old('password') }}" required />
                            </p>
                            <div class="summary-item payment-method">
                                <button type="submit" class="btn btn-medium">Valider ma commande</button>
                            </div>
                        </div>
                    </form>
                </center>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
