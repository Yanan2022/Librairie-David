<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
	<base href="/" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Tableau de bord</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="fontend/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="fontend/assets/css/ready.css">
	<link rel="stylesheet" href="fontend/assets/css/demo.css">

    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.6.1/css/ol.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="http://www.liedman.net/openlayers-routing-machine/dist/openlayers-routing-machine.css" type="text/css"> -->


	<!-- <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css"> -->
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->

    <!-- <script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script> -->


	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.css" integrity="sha512-eD3SR/R7bcJ9YJeaUe7KX8u8naADgalpY/oNJ6AHvp1ODHF3iR8V9W4UgU611SD/jI0GsFbijyDBAzSOg+n+iQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js" integrity="sha512-FW2A4pYfHjQKc2ATccIPeCaQpgSQE1pMrEsZqfHNohWKqooGsMYCo3WOJ9ZtZRzikxtMAJft+Kz0Lybli0cbxQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="/admin" class="logo">
					<img src="{{asset('logo.png')}}" alt="logo" style="width: 50%">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-bell"></i>
								<span class="notification">3</span>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> 
								<img src="fontend/assets/img/profile.jpg" alt="user-img" width="36" class="img-circle">
                                <span >{{Auth::user()['nom'].' '.Auth::user()['prenom']}}</span></span>
                            </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-text">
											<h4>{{Auth::user()['nom'].' '.Auth::user()['prenom']}}</h4>
											<p class="text-muted">
                                                {{Auth::user()['email']}}
										</div>
									</li>
									<div class="dropdown-divider">
                                    </div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Deconnexion
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
							</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
                            {{-- <img src="{{ asset('images/'.Auth::user()->photo) }}" class="img-circle user-img-circle" alt="photo"> --}}
							{{-- <img src="fontend/assets/img/profile.jpg" alt="user-img" width="100" class="img-circle"> --}}
							<img src="fontend/assets/img/profile.jpg"   alt="photo">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{Auth::user()['nom'].' '.Auth::user()['prenom']}}
                                    @if (Auth::User()['role_id'] == 0)
									    <span class="user-level">Administrateur</span>
                                    @elseif (Auth::User()['role_id'] == 1)
                                        <span class="user-level">Vendeur</span>
                                    @endif
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">Mon Profil</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Editer Profil</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Paramètres</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
                        @if(Auth::user()['role_id'] == 0 || Auth::user()['role_id'] == 1)
                            <li class="nav-item active">
                                <a href="/admin">
                                    <i class="la la-dashboard"></i>
                                    <p>Accueil</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="{{ route("commandes.index") }}">
                                    <i class="la la-road"></i>
                                    <p>Suivi Commandes</p>
                                </a>
                            </li> 
							<li class="nav-item">
                                <a href="{{ route("historique-vendeur") }}">
                                    <i class="la la-road"></i>
                                    <p>Historique Vente</p>
                                </a>
                            </li> 
							<li class="nav-item">
                                <a href="{{ route("commentairevendeurs.index") }}">
                                    <i class="la la-road"></i>
                                    <p>Commentaire Vendeur</p>
                                </a>
                            </li> 
                        @endif
                        @if(Auth::user()['role_id'] == 0)
							<li class="nav-item">
								<a href="{{ route('classes.index') }}">
									<i class="la la-folder-o"></i>
									<p>Classes</p>

								</a>
							</li>
                            <li class="nav-item">
                                <a href="/catArt">
                                    <i class="la la-folder-o"></i>
                                    <p>Categorie Artcles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/article">
                                    <i class="la la-keyboard-o"></i>
                                    <p>Articles</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('kitscolaires.index')}}">
                                    <i class="la la-keyboard-o"></i>
                                    <p>Kits scolaires</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('coupons.index')}}">
                                    <i class="la la-money"></i>
                                    <p>Code Promo</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="{{route('kitecoles.index')}}">
                                    <i class="la la-money"></i>
                                    <p>Ecoles</p>

                                </a>
                            </li>
							<li class="nav-item">
                                <a href="{{route('vendeurs.index')}}">
                                    <i class="la la-money"></i>
                                    <p>Vendeur</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('commentaires.index')}}">
                                    <i class="la la-money"></i>
                                    <p>Motif Commande Annulée</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('encarts.index') }}">
                                    <i class="la la-folder-o"></i>
                                    <p>Encart publicitaire</p>
                                </a>
                            </li>

							<li class="nav-item">
                                <a href="{{route('vendeurs.index')}}">
                                    <i class="la la-money"></i>
                                    <p>Vendeur</p>

                                </a>
                            </li>
                        @endif

					</ul>
				</div>
			</div>

            <div class="main-panel">
                <div class="content">
                @yield('content')
                </div>

            </div>



		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
					<p>
						<b>We'll let you know when it's done</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="fontend/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="fontend/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="fontend/assets/js/core/popper.min.js"></script>
<script src="fontend/assets/js/core/bootstrap.min.js"></script>
<script src="fontend/assets/js/plugin/chartist/chartist.min.js"></script>
<script src="fontend/assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="fontend/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="fontend/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="fontend/assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="fontend/assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="fontend/assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="fontend/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="fontend/assets/js/ready.min.js"></script>
<script src="fontend/assets/js/demo.js"></script>
</html>
