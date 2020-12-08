@extends('templates.default')

@section('content')
<div class="container mb-2">
    <p class="h1 text-center mb-2">{{ $publication->title }}</p>

    @if (session('success'))
    <div class="alert alert-success mb-2"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif

    <div class="card rounded shadow bg-white border-bottom-primary">
        <div class="mw-100">
            <img src="{{ asset('storage/images/'.$publication->photo) }}" alt="{{ $publication->title }}"
                class="w-100 rounded-top">
        </div>
        <p class="bg-dark text-white text-center rounded-bottom pb-2">
            {{ $publication->created_at }}
        </p>
        <p>
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
        </p>
        <p class="h5 pl-2 pt-2">
            {{ $publication->title }}
        </p>

        <p class="pl-2 pt-2">
            <span class="badge badge-info">Cat&eacute;gorie</span> {{ $publication->category->namecategory }} <br>
        </p>

        {!! $publication->content !!}
    </div>
</div>

@endsection
