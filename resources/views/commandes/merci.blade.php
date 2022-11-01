@extends("layouts")
@section("title")
    Merci !
@endsection
@section("content")
    <!--main area-->
	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="{{ url("/") }}" class="link">Accueil</a></li>
					<li class="item-link"><span>Commande</span></li>
				</ul>
			</div>
		</div>

		<div class="container pb-60">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2>Votre commande a bien été soumise !</h2>
                    <p>Vous allez éventuellement recevoir une confirmation par e-mail. Merci !</p>
                    <a href="{{ url("/catal") }}" class="btn btn-submit btn-submitx">Continuer mes achat</a>
				</div>
			</div>
		</div><!--end container-->

	</main>
	<!--main area-->
@endsection
