@extends('templates.default')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800 text-center">
            Cr&eacute;ation d'une page
        </h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <form action="{{ route('pages.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-control-label">Titre</label>
                    <input type="text" id="title" name="title" placeholder="Entrez le titre"
                        class="form-control form-control-sm" value="{{ old('title') }}">
                    @error('title')
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle mr-1"></i>{{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="editor" class="form-control-label">Contenu</label>
                    <textarea id="editor2" name="content">{{ old('content') }}</textarea>
                    @error('content')
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle mr-1"></i>{{$message}}
                    </div>
                    @enderror
                </div>
                <button type="reset" class="btn btn-sm btn-primary">Annuler</button>
                <button type="submit" class="btn btn-sm btn-primary">Cr&eacute;er</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/page.js')}}"></script>
<script>
    CKEDITOR.replace('editor2', {
        filebrowserUploadUrl: "{{route('pages.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        language: 'fr'
    });
</script>
@endsection