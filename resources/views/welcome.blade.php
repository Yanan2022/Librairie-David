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
				<a href="#" class="logo">
					Librairie Tableau de bord
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">

					<form class="navbar-left navbar-form nav-search mr-md-3" action="">
						<div class="input-group">
							<input type="text" placeholder="Search ..." class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
							</div>
						</div>
					</form>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-envelope"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-bell"></i>
								<span class="notification">3</span>
							</a>
							<ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notification</div>
								</li>
								<li>
									<div class="notif-center">
										<a href="#">
											<div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
											<div class="notif-content">
												<span class="block">
													New user registered
												</span>
												<span class="time">5 minutes ago</span>
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
											<div class="notif-content">
												<span class="block">
													Rahmad commented on Admin
												</span>
												<span class="time">12 minutes ago</span>
											</div>
										</a>
										<a href="#">
											<div class="notif-img">
												<img src="assets/img/profile2.jpg" alt="Img Profile">
											</div>
											<div class="notif-content">
												<span class="block">
													Reza send messages to you
												</span>
												<span class="time">12 minutes ago</span>
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
											<div class="notif-content">
												<span class="block">
													Farrah liked Admin
												</span>
												<span class="time">17 minutes ago</span>
											</div>
										</a>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="fontend/assets/img/profile.jpg" alt="user-img" width="36" class="img-circle">
                                <span >{{Auth::user()['nom'].' '.Auth::user()['prenom']}}</span></span>
                            </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="fontend/assets/img/profile.jpg" alt="user"></div>
										<div class="u-text">
											<h4>{{Auth::user()['nom'].' '.Auth::user()['prenom']}}</h4>
											<p class="text-muted">
                                                {{Auth::user()['email']}}
                                            </p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
									<a class="dropdown-item" href="#"></i> My Balance</a>
									<a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
									<div class="dropdown-divider"></div>
									<div class="dropdown-divider">

                                    </div>
									{{-- <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a> --}}

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            Logout
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
                            <img src="{{ asset('images/'.Auth::user()->photo) }}" class="img-circle user-img-circle" alt="photo">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{Auth::user()['nom'].' '.Auth::user()['prenom']}}
                                    @if (Auth::User()['role_id'] == 0)
									    <span class="user-level">Administrateur</span>
                                    @elseif (Auth::User()['role_id'] == 1)
                                        <span class="user-level">Livreur</span>
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
                                <a href="/">
                                    <i class="la la-dashboard"></i>
                                    <p>Accueil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/liv">
                                    <i class="la la-automobile"></i>
                                    <p>Livraison</p>

                                </a>
                            </li>
                        @endif
                        @if(Auth::user()['role_id'] == 0)
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
                                <a href="{{route('kits.index')}}">
                                    <i class="la la-keyboard-o"></i>
                                    <p>Kits</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('accueil')}}">
                                    <i class="la la-keyboard-o"></i>
                                    <p>Libraire David</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/cout">
                                    <i class="la la-money"></i>
                                    <p>Cout</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('livreurs.index')}}">
                                    <i class="la la-money"></i>
                                    <p>Livreur</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('coupons.index')}}">
                                    <i class="la la-money"></i>
                                    <p>Code Promo</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('commentaires.index')}}">
                                    <i class="la la-money"></i>
                                    <p>Motif Commande Annulée</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("commandes.index") }}">
                                    <i class="la la-road"></i>
                                    <p>Suivi des commandes</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/listeEnt">
                                    <i class="la la-building"></i>
                                    <p>Liste Entreprises/Boutiques</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/entreprise">
                                    <i class="la la-building"></i>
                                    <p>Entreprises/Boutiques</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/categorie">
                                    <i class="la la-folder-o"></i>
                                    <p>Categorie entreprise</p>

                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('classes.index') }}">
                                    <i class="la la-folder-o"></i>
                                    <p>Classes</p>

                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('encarts.index') }}">
                                    <i class="la la-folder-o"></i>
                                    <p>Encart publicitaire</p>

                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('bannieres.index') }}">
                                    <i class="la la-folder-o"></i>
                                    <p>Bannière</p>

                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/pays">
                                    <i class="la la-flag-o"></i>
                                    <p>Pays</p>

                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/Tvehicule">
                                    <i class="la la-flag-o"></i>
                                    <p>Type Vehicule</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/vehicule">
                                    <i class="la la-flag-o"></i>
                                    <p>Véhicule</p>

                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/TColis">
                                    <i class="la la-flag-o"></i>
                                    <p>Type colis</p>

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
