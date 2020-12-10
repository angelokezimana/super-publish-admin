@extends('templates.default')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-2 text-gray-800">
            Mon profil
            <button type="button" class="mb-2 btn btn-primary btn-sm text-white btn-add-user" data-toggle="modal"
                data-target="#crud-modal-user">
                <i class="fas fa-plus mr-1"></i> Modifier mes informations
            </button>
        </div>
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
                <table class="table table-borderless w-auto">
                    <tbody class="h4">
                        <tr>
                            <td>Nom</td>
                            <td>: {{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <td>Pr&eacute;nom</td>
                            <td>: {{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Pseudo</td>
                            <td>: {{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td>R&ocirc;le</td>
                            <td>: {{ $user->role->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/user.js')}}"></script>
@endsection
