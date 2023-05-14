<header id="header" class="header header-style-1" style="background-image: url('{{asset('catalogue/banniere/background-noel.jpg')}}');">
    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                @foreach (App\Models\Encart::all() as $item)
                    <img src='/images/{{ $item->image }}' alt="{{ $item->libelle }}">
                @endforeach
                    {{--<img src="{{asset('catalogue/banniere/banniere.png')}}" alt="mercado"> --}}
            </div>

            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="{{ url('/') }}" class="link-to-home">
                            <img src="{{asset('logo.png')}}" alt="logo" style="width: 50%">
                        </a>
                    </div>
                    <div class="wrap-search center-section">
                        <div class="wrap-search-form">
                            <form action="{{ route('search') }}" id="form-search-top" name="form-search-top">
                                <input type="text" id="autocomplete" name="search" value="" placeholder="Rechercher">
                                <button form="form-search-top" type="button"><i class="fa fa-search"
                                        aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="wrap-icon right-section">
                        <div class="wrap-icon-section wishlist">
                            <a href="#" class="link-direction">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <div class="left-info">
                                    <span class="index">0 item</span>
                                    <span class="title" style="text-color: white">Wishlist</span>
                                </div>
                            </a>
                        </div>
                        <div class="wrap-icon-section minicart">
                            <a href="{{ route('listeCommande') }}" class="link-direction">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <div class="left-info">
                                    <span class="index">0</span>
                                    <span class="title">Panier</span>
                                </div>
                            </a>
                        </div>
                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-section header-sticky">
                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
                            <li class="menu-item home-icon">
                                <a href="{{ url('/') }}" class="link-term mercado-item-title">
                                    <i class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                           

                            @if (Session::has('client'))
                                <li class="menu-item">
                                    <a href="{{ route('listeCommande') }}" class="link-term mercado-item-title">Suivi commande</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{route('logout-client')}}" class="link-term mercado-item-title">
                                        {{ Session::get('client')->nom.' '.Session::get('client')->prenom }}
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{route('logout-client')}}" class="link-term mercado-item-title">Deconnexion</a>
                                </li>
                            @else
                                <li class="menu-item">
                                    <a href="{{route('signup')}}" class="link-term mercado-item-title">créer compte</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{route('login-client')}}" class="link-term mercado-item-title">Connexion</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{route('kits.index')}}" class="link-term mercado-item-title">kit scolaire</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
