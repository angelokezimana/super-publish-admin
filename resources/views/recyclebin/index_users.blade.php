@extends('templates.default')

@section('content')
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Users Deleted</li>
    </ol>

    <div>
        <p class="h1 text-center">Liste des utilisateurs supprimés</p>
        @if (session('success'))
        <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
        @endif
    </div>

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
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr @if ($user->banned_at) class="bg-danger" @endif>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <form action="users/restore/{{$user->id}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Voulez-vous vraiment restaurer cet utilisateur?')"
                                        data-toggle="tooltip" data-placement="top" title="restaurer cet utilisateur">
                                        <i class="fa fa-trash"></i>Restaurer
                                    </button>
                                </form>
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
