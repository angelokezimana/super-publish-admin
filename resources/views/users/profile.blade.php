@extends('templates.default')

@section('content')
<div class="container mb-2">
    <p class="h1 text-center">Mon profil</p>
    <button type="button" class="mb-2 btn btn-primary btn-sm text-white btn-add-user" data-toggle="modal" data-target="#crud-modal-user">
        <i class="fa fa-plus"></i> Modifier mes informations
    </button>
    @if (session('success'))
        <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif
</div>

<div class="row mb-2">
    <div class="col-md-3">
        <p class="text-muted">Nom:</p>
        <p>{{ $user->last_name }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted">Pr&eacute;nom:</p>
        <p>{{ $user->first_name }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted">E-mail:</p>
        <p>{{ $user->email }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted">Pseudo:</p>
        <p>{{ $user->username }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <p class="text-muted">R&ocirc;le:</p>
        <p>{{ $user->role->name }}</p>
    </div>
</div>

{{-- @include('users.partials.crud-modal-user') --}}
@endsection

@section('scripts')
    <script src="{{asset('js/User.js')}}"></script>
@endsection
