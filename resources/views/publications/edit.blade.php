@extends('templates.default')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800 text-center">
            Modification de la publication '{{ $publication->title }}'
        </h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">

            <form action="{{ route('publications.update', $publication) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="form-control-label">Titre</label>
                    <input type="text" id="title" name="title" placeholder="Entrez le titre"
                        class="form-control form-control-sm" value="{{ old('title') ?? $publication->title }}">
                    @error('title')
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle mr-1"></i>{{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customFile" class="form-control-label">Photo de couverture</label>
                    <div class="custom-file">
                        <input type="file" name="photo" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        @error('photo')
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle mr-1"></i>{{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id" class="form-control-label">cat&eacute;gorie</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="">Veuillez s&eacute;lectionner le type de cette publication</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {!! $publication->category_id==$category->id ?
                            'selected="selected"' : '' !!}>{{ $category->namecategory }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle mr-1"></i>{{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="editor" class="form-control-label">Contenu</label>
                    <textarea id="editor" name="content">{{ old('content') ?? $publication->content }}</textarea>
                    @error('content')
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle mr-1"></i>{{$message}}
                    </div>
                    @enderror
                </div>

                <button type="reset" class="btn btn-secondary btn-sm">Annuler</button>
                <button type="submit" id="id-form" class="btn btn-primary btn-sm crud-modal-user-form">Modifier</button>
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
@endsection
