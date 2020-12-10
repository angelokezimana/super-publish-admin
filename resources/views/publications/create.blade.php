@extends('templates.default')

@section('multi-step-form-css')
<link href="{{ asset('css/multi-step-form.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800 text-center">
            Cr&eacute;ation d'une publication
        </h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data" id="msform">
                @csrf
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active fas fa-check" id="step1"><strong>Etape 1</strong></li>
                    <li class="fas fa-check" id="step2"><strong>Etape 2</strong></li>
                </ul>
                <fieldset>
                    <div class="form-group">
                        <label for="title" class="form-control-label">Titre</label>
                        <input type="text" id="title" name="title" placeholder="Entrez le titre"
                            class="form-control form-control-sm">
                        <div class="alert alert-danger hidden"></div>
                    </div>
                    <div class="form-group">
                        <label for="customFile" class="form-control-label">Photo de couverture</label>
                        <div class="custom-file">
                            <input type="file" name="photo" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <div class="alert alert-danger hidden"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="form-control-label">cat&eacute;gorie</label>
                        <select id="category_id" name="category_id" class="form-control">
                            <option value="">Veuillez s&eacute;lectionner le type de cette publication</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->namecategory }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger hidden"></div>
                    </div>
                    <div class="form-group">
                        <label for="editor" class="form-control-label">Contenu</label>
                        <textarea id="editor"></textarea>
                        <div class="content alert alert-danger hidden"></div>
                    </div>
                    <button type="button" name="next" class="btn btn-sm btn-primary next action-button"><i
                            class="fas fa-arrow-right mr-1"></i>Suivant</button>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="form-control-label">Fichiers</label>
                        <input type="file" class="form-control" accept="application/pdf" id="multiple_files" multiple>
                        <div class="alert alert-danger hidden"></div>
                    </div>
                    <button type="button" name="previous"
                        class="previous action-button-previous btn btn-sm btn-secondary"><i
                            class="fas fa-arrow-left mr-1"></i>Précédent</button>
                    <button type="button" name="finish" class="btn btn-sm btn-primary finish-completion"><i
                            class="fas fa-check mr-1"></i>Confirmer</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/Publication.js')}}"></script>
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        language: 'fr'
    });
</script>
<script src="{{ asset('js/multi-step-form.js') }}"></script>
@endsection
