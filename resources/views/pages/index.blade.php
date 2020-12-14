@extends('templates.default')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">
            Liste des pages

            @can('Creer Pages')
            <a href="{{ route('pages.create') }}" class="mb-2 btn btn-primary btn-sm text-white">
                <i class="fa fa-plus"></i> Cr&eacute;er une page
            </a>
            @endcan
        </h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Contenu</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $page)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $page->title }}</td>
                            <td>{!! $page->content !!}</td>
                            <td>
                                <a href="{{ route('pages.show', $page) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye mr-1"></i>D&eacute;tails
                                </a>

                                @can('Modifier Pages')
                                <a href="{{ route('pages.edit', $page) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit mr-1"></i>Modifier
                                </a>
                                @endcan

                                @can('Supprimer Pages')
                                <form action="{{ route('pages.destroy', $page) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Voulez-vous vraiment supprimer cette entrée ?')">
                                        <i class="fas fa-trash-alt mr-1"></i>Supprimer</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection