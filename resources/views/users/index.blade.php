@extends('templates.default')

@section('content')
<div class="h1 text-center">Liste des utilisateurs</div>
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
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->banned_at }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier cet utilisateur">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('users.suspend', $user) }}" method="post" class="inline">
                        @csrf
                        @method('PUT')

                        @if ($user->banned_at)
                        <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('Voulez-vous vraiment débloquer cet utilisateur ?')" data-toggle="tooltip" data-placement="top" title="Débloquer cet utilisateur">
                            <i class="fas fa-unlock-alt"></i>
                        </button>
                        @else
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment bloquer cet utilisateur ?')" data-toggle="tooltip" data-placement="top" title="Bloquer cet utilisateur">
                            <i class="fas fa-user-lock"></i>
                        </button>
                        @endif
                    </form>

                    <form action="{{ route('users.destroy', $user) }}" method="post" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette entrée ?')" data-toggle="tooltip" data-placement="top" title="Supprimer cet utilisateur">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
