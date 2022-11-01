@extends('welcome')
@section('title','Catégories')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Liste des catégories colis</h4>        
        <div class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <a class="btn btn-success" href="javascript:;" data-toggle="modal" data-target="#exampleModalCenter" ><i class="la la-folder-open"></i></a>
        </div>

    </div>
    <div class="card-body">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Libellé</th>
					<th></th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($typecolis as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->LibelleType}}</td>
                       
                        <td>
                        <button class="btn btn-warning"><i class="la la-edit"></i></button>
                        <button class="btn btn-info"><i class="la la-search-plus"></i></button>
                        <button class="btn btn-danger"><i class="la la-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
                        
        </table>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header bg-success">
        <h6 class="modal-title"><i class="la la-folder-open"></i> Ajout d'une catégorie</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
	</div>
     
      <div class="modal-body">
           <form role="form" action="{{ route('TColi.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                <div class="form-group">
                    <label for="largeInput">Désignation</label>
                    <input type="text" class="form-control form-control" id="LibelleType" name="LibelleType" placeholder="Code article">
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
        $('#example').DataTable();
            } );
    </script>

@endsection