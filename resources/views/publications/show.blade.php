@extends('templates.default')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800 text-center">
            {{ $publication->title }} |
            {{ $publication->created_at }} |
            {{ $publication->category->namecategory }} |
            <a href="{{ route('publications.edit', $publication) }}" class="btn btn-primary btn-sm">
                Modifier
            </a>
            <form action="{{ route('publications.destroy', $publication) }}" method="post" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Voulez-vous vraiment supprimer cette entrée ?')">
                    Supprimer
                </button>
            </form>
        </h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success mb-2"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            {!! $publication->content !!}
        </div>
    </div>
</div>

@endsection
