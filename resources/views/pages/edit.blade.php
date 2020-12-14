@extends('templates.default')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800 text-center">
            Modification de la page '{{ $page->title }}'
        </h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">

            <form action="{{ route('pages.update', $page) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="form-control-label">Titre</label>
                    <input type="text" id="title" name="title" placeholder="Entrez le titre"
                        class="form-control form-control-sm" value="{{ old('title') ?? $page->title }}">
                    @error('title')
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle mr-1"></i>{{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="editor" class="form-control-label">Contenu</label>
                    <textarea id="editor" name="content">{{ old('content') ?? $page->content }}</textarea>
                    @error('content')
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle mr-1"></i>{{$message}}
                    </div>
                    @enderror
                </div>

                <button type="reset" class="btn btn-secondary btn-sm">Annuler</button>
                <button type="submit" id="id-form" class="btn btn-primary btn-sm">Modifier</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: "{{route('pages.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        language: 'fr'
    });
</script>
@endsection