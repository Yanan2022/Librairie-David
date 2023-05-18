@extends("front.layouts.app") 
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
					<li class="item-link"><a href="{{ route("commandes.index") }}" class="link">Commandes</a></li>
					<li class="item-link"><a href="{{ route("commandes.show", $commande) }}" class="link">Commande #{{ $commande->id }}</a></li>
					<li class="item-link"><span>Commande validée</span></li>
				</ul>
			</div>
		</div>

		<div class="container pb-60">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2>Vous avez bien accepté la commande du client !</h2>
                    <p>vous devez contacter le client au <span class="badge badge-light">{{ $commande->telephone }}</span>. Merci !</p>
                    <a href="{{ route("commandes.index") }}" class="btn btn-submit btn-submitx">Voir les autres commandes</a>
				</div>
			</div>
		</div><!--end container-->

	</main>
	<!--main area-->
@endsection
