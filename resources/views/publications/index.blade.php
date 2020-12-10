@extends('templates.default')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">
            Liste des publications
            <a href="{{ route('publications.create') }}" class="mb-2 btn btn-primary btn-sm text-white">
                <i class="fa fa-plus"></i> Cr&eacute;er une publication
            </a>
        </h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif

    @foreach ($publications->chunk(3) as $chunk)
    <div class="row mb-2">
        @foreach ($chunk as $publication)
        <div class="col-md-4">
            <div class="card rounded shadow bg-white border-bottom-primary">
                <div class="mw-100">
                    <a href="{{ route('publications.show', $publication) }}">
                        <img src="{{ asset('storage/images/'.$publication->photo) }}" alt="{{ $publication->title }}"
                            class="w-100 rounded-top">
                    </a>
                </div>
                <p class="bg-dark text-white text-center rounded-bottom pb-2">
                    <strong>{{ $publication->created_at }}</strong>
                </p>
                <p class="h5 pl-2 pt-2">
                    <a href="{{ route('publications.show', $publication) }}" class="text-dark text-decoration-none">
                        {{ $publication->title }}
                    </a>
                </p>
                <p class="pl-2 pt-2">
                    <span class="badge badge-info">Cat&eacute;gorie</span> {{ $publication->category->namecategory }}
                    <br>
                </p>
                <div class="card-footer">

                    @can('Modifier Evenements')
                    <a href="{{ route('publications.edit', $publication) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit mr-1"></i>Modifier
                    </a>
                    @endcan

                    @can('Supprimer Evenements')
                    <form action="{{ route('publications.destroy', $publication) }}" method="post" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Voulez-vous vraiment supprimer cette entrée ?')">
                            <i class="fas fa-trash-alt mr-1"></i>Supprimer</button>
                    </form>
                    @endcan

                </div>
            </div>
        </div><!-- /# column -->
        @endforeach
    </div>
    @endforeach
    {{ $publications->links() }}

</div>
@endsection
