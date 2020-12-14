@extends('templates.default')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">
            {{ $page->title }}
        </h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            {!! $page->content !!}
        </div>
    </div>
</div>

@endsection
