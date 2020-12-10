@extends('templates.default')

{{-- section Chartjs-css --}}
@section('chartjs-css')
<link rel="stylesheet" href="{{ asset('css/Chart.min.css') }}">
@endsection

{{-- section Chartjs-js --}}
@section('chartjs-js')
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>
    var dataBarCategory = {
        xLabels: {!! $category_name !!},
        datasets: [{
            data: {!! $publications_count_per_category !!},
            borderColor: 'rgba(32,18,191, 1)',
            backgroundColor: 'rgba(32,18,191, 0.5)',
            borderWidth: 1
        }]
    }
    var dataBarUser = {
        labels: {!! $creator !!},
        datasets: [{
            data: {!! $publications_count_per_creator !!},
            borderColor: 'rgba(32,18,191, 1)',
            backgroundColor: 'rgba(32,18,191, 0.5)',
            borderWidth: 1
        }]
    }
</script>
<script src="{{ asset('js/my-chart.js') }}"></script>
@endsection

{{-- section content --}}
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Rapports</h1>
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
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Recherche
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('reports.search') }}" method="post">
                @csrf

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="start_date" class="form-control-label"><small>Date début</small></label>
                        <input type="datetime-local" id="start_date" name="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" value="{{ old("start_date") }}">
                        @error('start_date')
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle mr-1"></i>{{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="end_date" class="form-control-label"><small>Date fin</small></label>
                        <input type="datetime-local" id="end_date" name="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" value="{{ old("end_date") }}">
                        @error('end_date')
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle mr-1"></i>{{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4 pt-4 mt-2">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-search mr-1"></i>Rechercher
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <canvas id="myChartBarCategory" width="400" height="150"></canvas>
        </div>
    </div>
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <canvas id="myChartBarCreator" width="400" height="150"></canvas>
        </div>
    </div>
</div>
{{ session()->forget('success') }}
@endsection
