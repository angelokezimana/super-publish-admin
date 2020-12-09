@extends('templates.default')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">
            Liste des utilisateurs
            <button type="button" class="mb-2 btn btn-primary btn-sm text-white btn-add-user" data-toggle="modal"
                data-target="#crud-modal-user">
                <i class="fas fa-user-plus mr-1"></i> Cr&eacute;er un utilisateur
            </button>
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
                            <th>Pr&eacute;nom</th>
                            <th>E-mail</th>
                            <th>Pseudo</th>
                            <th>R&ocirc;les</th>
                            <th>Bloqu&eacute;</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr @if ($user->banned_at) class="table-danger" @endif>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{!! $user->banned_at ?? '<label class="badge badge-success">Pas bloqu&eacute;</label>'
                                !!}</td>
                            <td>
                                @if($user->id != auth()->user()->id)
                                <button type="button" class="btn btn-primary btn-sm text-white btn-edit-user"
                                    data-toggle="modal" data-target="#crud-modal-user" data-id="{{ $user->id }}"
                                    data-last_name="{{ $user->last_name }}" data-first_name="{{ $user->first_name }}"
                                    data-email="{{ $user->email }}" data-username="{{ $user->username }}"
                                    data-role_id="{{ $user->role->id }}" data-role_name="{{ $user->role->name }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('users.suspend', $user) }}" method="post" class="inline">
                                    @csrf
                                    @method('PUT')

                                    @if ($user->banned_at)
                                    <button type="submit" class="btn btn-info btn-sm"
                                        onclick="return confirm('Voulez-vous vraiment débloquer cet utilisateur ?')"
                                        data-toggle="tooltip" data-placement="top" title="Débloquer cet utilisateur">
                                        <i class="fa fa-unlock-alt"></i>
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Voulez-vous vraiment bloquer cet utilisateur ?')"
                                        data-toggle="tooltip" data-placement="top" title="Bloquer cet utilisateur">
                                        <i class="fa fa-lock"></i>
                                    </button>
                                    @endif
                                </form>

                                <form action="{{ route('users.destroy', $user) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Voulez-vous vraiment supprimer cette entrée ?')"
                                        data-toggle="tooltip" data-placement="top" title="Supprimer cet utilisateur">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('users.partials.crud-modal-user')
@endsection

@section('scripts')
<script src="{{asset('js/user.js')}}"></script>
@endsection
