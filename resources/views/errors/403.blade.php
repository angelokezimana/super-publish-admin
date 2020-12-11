@extends('templates.default')

@section('content')
<div class="container-fluid">
    <div class="text-center">
        <div class="error mx-auto" data-text="403">403</div>
        <p class="lead text-gray-800 mb-5">Acc&egrave;s Interdit</p>
        <p class="text-gray-500 mb-0">L'accès à la ressource demandée est interdit pour une raison quelconque. <br>
            Contactez votre administrateur pour plus de d&eacute;tails.</p>
        <a href="{{ auth()->check() ? route('home') : url('/') }}">&larr; Retour &agrave; l'accueil</a>
    </div>
</div>
@endsection
