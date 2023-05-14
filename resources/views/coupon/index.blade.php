@extends('welcome')
@section('title', 'code promos')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Liste des codes promos</h4>
            <div class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <a class="btn btn-success" href="javascript:;" data-toggle="modal" data-target="#exampleModalCenter"><i
                        class="la la-folder-open"></i></a>
            </div>

        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Pourcentage</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Bouton action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $item)
                        <tr>
                            <td>
                                {{ $item->code }}
                            </td>
                            <td>{{ $item->percent_off }}</td>
                            <td>{{ $item->date_debut }}</td>
                            <td>{{ $item->date_fin }}</td>
                            <td>
                                <a href="{{ route('codepromos.edit', $item->id) }}" class="btn btn-warning"><i
                                        class="la la-edit"></i></a>
                                <button class="btn btn-info"><i class="la la-search-plus"></i></button>
                                <button class="btn btn-danger delete-row"
                                    data-uri="{{ route('codepromos.destroy', $item->id) }}">
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
                    <h6 class="modal-title"><i class="la la-folder-open"></i> Ajouter un nouveau coupon</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form role="form" action="{{ route('coupons.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="CodeArticle">Code</label>
                            <input type="text" class="form-control form-control" id="code" name="code"
                                placeholder="Code">
                        </div>
                        <div class="form-group">
                            <label for="LibelleArticle">Pourcentage</label>
                            <input type="text" class="form-control form-control" id="percent_off" name="percent_off"
                                placeholder="Pourcentage">
                        </div>

                        <div class="form-group">
                            <label for="date_debut">Date début</label>
                            <input type="date" class="form-control form-control" id="date_debut" name="date_debut"
                                placeholder="Date début">
                        </div>
                        <div class="form-group">
                            <label for="date_fin">Date fin</label>
                            <input type="date" class="form-control form-control" id="date_fin" name="date_fin"
                                placeholder="Date fin">
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
