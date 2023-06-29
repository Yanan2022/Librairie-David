@extends('welcome')
@section('title', 'Articles')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Liste des vendeurs</h4>
            <div class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <a class="btn btn-success" href="javascript:;" data-toggle="modal" data-target="#exampleModalCenter"><i
                        class="la la-folder-open"></i></a>
            </div>

        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Contact</th>
                        <th>Aperçu</th>
                        <th>Email</th>
                        <th>Bouton action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($livreurs as $item)
                        <tr>
                            <td>
                                {{ $item->nom }} 
                            </td>
                            <td>{{ $item->prenom }}</td>
                            <td>{{ $item->contact }}</td>
                            <td><img src='images/{{ $item->photo }}' style="height:30px;widght:30px;"></td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('vendeurs.edit', $item->id) }}" class="btn btn-warning"><i
                                        class="la la-edit"></i></a>
                                <button class="btn btn-info"><i class="la la-search-plus"></i></button>
                                <button class="btn btn-danger delete-row"
                                    data-uri="{{ route('vendeurs.destroy', $item->id) }}">
                                    <i class="la la-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h6 class="modal-title"><i class="la la-folder-open"></i> Ajouter un nouveau vendeur</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form role="form" action="{{ route('livreurs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="CodeArticle">Nom</label>
                            <input type="text" class="form-control form-control" id="CodeArticle" name="nom"
                                placeholder="Nom">
                        </div>
                        <div class="form-group">
                            <label for="LibelleArticle">Prénom</label>
                            <input type="text" class="form-control form-control" id="LibelleArticle" name="prenom"
                                placeholder="Prénom">
                        </div>

                        <div class="form-group">
                            <label for="PrixArticle">Contact</label>
                            <input type="text" class="form-control form-control" id="PrixArticle" name="contact"
                                placeholder="Contact">
                        </div>
                        <div class="form-group">
                            <label for="PrixArticle">Email</label>
                            <input type="email" class="form-control form-control" id="email" name="email"
                                placeholder="Contact">
                        </div>
                        <div class="form-group">
                            <label for="ImageArticle">Photo Livreur</label>
                            <input type="file" class="form-control form-control" id="photo" name="photo"
                                placeholder="Photo livreur">
                        </div>

                        <div>
                            <button type="button" class="btn btn-wating" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();

            $(".delete-row").click(function(e) {
                e.preventDefault();
                if (confirm("Voulez-vous vraiment supprimer cet élément ?")) {
                    $.post($(this).data("uri"), {
                            _method: "delete",
                            _token: "{{ csrf_token() }}"
                        })
                        .done(function(res) {
                            $.notify({
                                icon: 'la la-check',
                                title: 'Information',
                                message: res.message,
                            }, {
                                type: 'success',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                                time: 3000,
                            });
                            window.location.reload();
                        })
                        .fail(function(err) {
                            $.notify({
                                icon: 'la la-times',
                                title: 'Erreur',
                                message: err.responseJSON?.message,
                            }, {
                                type: 'error',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                                time: 3000,
                            });
                        });
                }
            })
        });
    </script>
@endsection
