@extends('templates.default')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">
            Liste des r&ocirc;les

            @can('Creer Roles')
            <button type="button" class="mb-2 btn btn-primary btn-sm text-white btn-add-role" data-toggle="modal"
                data-target="#crud-modal-role">
                <i class="fas fa-plus mr-1"></i> Cr&eacute;er un r&ocirc;le
            </button>
            @endcan
        </h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Permissions</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $role->name }}</td>
                            <td>
                                @forelse ($role->permissions()->pluck('name') as $permission)
                                <label class="badge badge-success">{{ $permission }}</label>
                                @empty
                                <label class="badge badge-danger">Aucun</label>
                                @endforelse
                            </td>
                            <td>
                                @can('Modifier Roles')
                                <button type="button" class="btn btn-primary btn-sm text-white btn-edit-role"
                                    data-toggle="modal" data-target="#crud-modal-role" data-id="{{ $role->id }}"
                                    data-name="{{ $role->name }}" data-permissions="{{ implode(',', $role->permissions()->pluck('id')->toArray()) }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @endcan

                                @can('Supprimer Roles')
                                <form action="{{ route('roles.destroy', $role) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Voulez-vous vraiment supprimer cette entrée ?')"
                                        data-toggle="tooltip" data-placement="top" title="Supprimer cet utilisateur">
                                        <i class="fa fa-trash"></i>
                                    </button>
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

@if(auth()->user()->hasAnyPermission(['Creer Roles','Modifier Roles']))
@include('roles.partials.crud-modal-role')
@endif

@endsection

@section('scripts')
<script src="{{asset('js/role.js')}}"></script>
@endsection
