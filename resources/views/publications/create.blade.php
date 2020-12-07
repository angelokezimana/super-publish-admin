@extends('templates.default')

@section('content')
<div class="container mb-2">
    <p class="h1 text-center">Cr&eacute;ation d'une publication</p>

    @if (session('success'))
    <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif
</div>

<form>
    <div class="form-group">
        <label for="title" class="form-control-label">Titre</label>
        <input type="text" id="title" name="title" placeholder="Entrez le titre" class="form-control form-control-sm">
    </div>
    <div class="form-group">
        <label for="category_id" class="form-control-label">cat&eacute;gorie</label>
        <select id="category_id" name="category_id" class="form-control">
            <option value="">Veuillez s&eacute;lectionner le type de cette publication</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->namecategory }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="summernote" class="form-control-label">Contenu</label>
        <textarea id="summernote" name="content"></textarea>
    </div>

    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
    <button type="button" id="id-form" class="btn btn-primary btn-sm crud-modal-user-form">Cr&eacute;er</button>
</form>

@endsection