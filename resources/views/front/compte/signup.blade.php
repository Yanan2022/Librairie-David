@extends("front.layouts.app")

@section("title")
    créer compte
@endsection

@section("content")
<main id="main" class="main-site left-sidebar">

    <main id="main" class="main-site left-sidebar">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">accueil</a></li>
					<li class="item-link"><span>Créer compte</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
					<div class=" main-content-area">
						<div class="wrap-login-item ">
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
								<form action="{{ route('creerCompte') }}" method="post" class="form-stl"  name="frm-login">
									@csrf
                                    <fieldset class="wrap-title">
										<h3 class="form-title">Créer un compte</h3>
										<h4 class="form-subtitle">
                                            Informations personnelles
                                        </h4>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-reg-lname">Nom*</label>
										<input type="text" id="frm-reg-lname" name="nom" placeholder="Nom*">
									</fieldset>
                                    <fieldset class="wrap-input">
										<label for="frm-reg-lname">Prénom*</label>
										<input type="text" id="frm-reg-lname" name="prenom" placeholder="Prénom*">
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-reg-email">Adresse Email*</label>
										<input type="email" id="frm-reg-email" name="email" placeholder="Adresse Email">
									</fieldset>
                                    <fieldset class="wrap-input">
										<label for="frm-reg-email">Numéro Téléphone*</label>
										<input type="text" id="frm-reg-numero" name="numero" placeholder="Numéro Téléphone">
									</fieldset>
									<fieldset class="wrap-title">
										<h3 class="form-title">Informations de connexion</h3>
									</fieldset>
									<fieldset class="wrap-input item-width-in-half left-item ">
										<label for="frm-reg-pass">Mot de passe *</label>
										<input type="password" id="frm-reg-pass" name="password" placeholder="Mot de passe">
									</fieldset>
									<fieldset class="wrap-input item-width-in-half ">
										<label for="frm-reg-cfpass">Confirmez le mot de passe *</label>
										<input type="password" id="frm-reg-cfpass" name="reg-cfpass" placeholder="Confirmer mot de passe">
									</fieldset>
									<input type="submit" class="btn btn-sign" value="Enregistrer" name="register">
								</form>
							</div>
						</div>
					</div><!--end main products area-->
				</div>
			</div><!--end row-->

		</div><!--end container-->

	</main>

</main>
@endsection
