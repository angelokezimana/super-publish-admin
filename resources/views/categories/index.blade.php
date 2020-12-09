@extends('templates.default')

@section('content')
<div class="container-fluid">

  <ol class="breadcrumb">
    <li><a href="#">
        <em class="fa fa-home"></em>
      </a></li>
    <li class="active">Categories</li>
  </ol>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">
      Liste des categories
      <button type="button" data-toggle="modal" data-target="#formulaire" class="mb-2 btn btn-sm btn-primary text-white btn-add-category">
        <i class="fas fa-plus mr-1"></i>Ajouter une categorie
      </button>
    </h1>
  </div>

  @if (Session::has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

  <div class="card shadow mb-4 border-bottom-primary">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-warning ">
            <tr>

              <th>Numero</th>
              <th>Nom </th>
              <th>Enregistr&eacute; par </th>
              <th>Date d'enregistrement</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php  $i=1 ?>
            @foreach($categories as $categorie)
            <tr>
              <td><?= $i ?></td>
              <td>{{$categorie->namecategory}}
                <br> {{$categorie->category_id}}
              </td>
              <td>{{$categorie->username}}</td>
              <td>{{$categorie->created_at}}</td>
              <td>

                <form action="categories/destroy/{{$categorie->id}}" method="post">
                  <a href="" class="btn btn-primary btn-edit-category" title="Editer" data-toggle="modal"
                    data-target="#formulaire" data-id="{{$categorie->id}}"
                    data-namecategory="{{$categorie->namecategory}}" data-category_id="{{$categorie->category_id}}"><i
                      class="fa fa-edit"></i></a>
                  @csrf
                  <button type="submit" onclick="return confirm('voulez-vous supprimer cette categorie ?')"
                    class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button>
                </form>
              </td>
            </tr>
            <?php $i++ ?>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@include('categories.modals.modal')
@endsection

@section('scripts')
<script src="{{ asset('js/Category.js') }}"></script>
@endsection
