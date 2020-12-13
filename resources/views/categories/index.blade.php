@extends('templates.default')

@section('content')
<div class="container-fluid">

	<ol class="breadcrumb">
		<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
		<li class="active">Categories</li>
	</ol>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-2 text-gray-800">
			Liste des categories

			@can('Creer Categories')
			<button type="button" data-toggle="modal" data-target="#formulaire"
				class="mb-2 btn btn-sm btn-primary text-white btn-add-category">
				<i class="fas fa-plus mr-1"></i>Ajouter une categorie
			</button>
			@endcan
		</h1>
	</div>

	@if (Session::has('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ Session::get('success') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	<div class="card shadow mb-4 border-bottom-primary">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="dataTable" width="100%"
					cellspacing="0">
					<thead class="thead-warning ">
						<tr>
							<th>#</th>
							<th>Nom </th>
							<th>Date d'enregistrement</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="accordion" id="exempleAccordeon">
						@foreach($categories as $categorie)
						<tr class="accordion-toggle collapsed" data-toggle="collapse"
							data-target="#collapse{{$categorie->id}}" aria-expanded="false"
							aria-controls="collapse{{$categorie->id}}" data-parent="#exempleAccordeon">
							<td class="expand-button"><i class="fa fa-circle"></i></td>
							<td>{{$categorie->namecategory}}
								<br> {{$categorie->category_id}}
							</td>
							<td>{{$categorie->created_at}}</td>
							<td>
								@can('Modifier Categories')
								<a href="" class="btn btn-primary btn-edit-category" title="Editer" data-toggle="modal"
									data-target="#formulaire" data-id="{{$categorie->id}}"
									data-namecategory="{{$categorie->namecategory}}"
									data-category_id="{{$categorie->category_id}}"><i class="fa fa-edit"></i>
								</a>
								@endcan

								@can('Supprimer Categories')
								<form action="categories/destroy/{{$categorie->id}}" method="post" class="inline">
									@csrf
									<button type="submit"
										onclick="return confirm('voulez-vous supprimer cette categorie ?')"
										class="btn btn-danger btn-xs" title="Delete"><i
											class="fa fa-trash"></i></button>
								</form>
								@endcan
							</td>
						</tr>
						@foreach($categorie->categories as $category)
						<tr class="hide-table-padding">
							<td></td>
							<td colspan="3">
								<div class="collapse" id="collapse{{$categorie->id}}">
									<div class="row">
										{{-- <div class="col-md-2"><i class="fa fa-ping"></i></div> --}}
										<div class="col-md-2">{{$category->namecategory}}</div>
										<div class="col-md-6">{{$category->created_at}}</div>
										<div class="col-md-4">

											@can('Modifier Categories')
											<a href="#" class="btn btn-sm btn-primary btn-edit-category" title="Editer"
												data-toggle="modal" data-target="#formulaire"
												data-id="{{$category->id}}"
												data-namecategory="{{$category->namecategory}}"
												data-category_id="{{$category->category_id}}"><i class="fas fa-edit"></i>
											</a>
											@endcan

											@can('Supprimer Categories')
											<form action="categories/destroy/{{$category->id}}" method="post" class="inline">
												@csrf
												<button type="submit"
													onclick="return confirm('voulez-vous supprimer cette categorie ?')"
													class="btn btn-danger btn-sm" title="Delete"><i
														class="fa fa-trash"></i></button>
											</form>
											@endcan
										</div>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@if(auth()->user()->hasAnyPermission(['Creer Categories','Modifier Categories']))
@include('categories.modals.modal')
@endif

@endsection

@section('scripts')
<script src="{{ asset('js/Category.js') }}"></script>
@endsection