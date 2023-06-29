@extends("front.layouts.app")

@section("title")
    Connexion
@endsection

@section("content")  
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">accueil</a></li>
                <li class="item-link"><span>login</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="login-form form-item form-stl">
                            <div class="register-form form-item ">
                                @if (Session::has('status'))
                                <div class="alert alert-success">
                                    {{Session::get('status')}}
                                </div>
                            @endif
                            @if (count($errors)>0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error )
                                            <li>{{$errors}}<li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('login') }}" method="post" name="frm-login">
                                @csrf
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Connectez-vous à votre compte administrateur</h3>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-uname">Adresse Email :</label>
                                    <input type="text" id="frm-login-uname" name="email" placeholder="Type your email address">
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-pass">Mot de passe:</label>
                                    <input type="password" id="frm-login-pass" name="password" placeholder="************">
                                </fieldset>
                                <input type="submit" class="btn btn-submit" value="Connexion" name="submit">
                            </form>
                            <hr>
                        </div>
                    </div>
                </div><!--end main products area-->
            </div>
        </div><!--end row-->

    </div><!--end container-->

</main>
@endsection
