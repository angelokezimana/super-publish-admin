<!-- Debut  formulaire -->
<div class="modal fade" id="formulaire" tabindex="-1" role="dialog" aria-labelledby="crud-modal-category-label"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="crud-modal-category-label">Ajouter cat&eacute;gorie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form>
				<input type="hidden" name="category_id" id="category_id">
				<div class="modal-body">
					<div class="form-group">
						<label for="namecategory" class="form-control-label">Nom de la cat&eacute;gorie</label>
						<input type="text" id="namecategory" name="namecategory"
							placeholder="Entrer le nom de la cat&eacute;gorie (ex. sport, actualite, ...)"
							class="form-control form-control-sm">
						<div class="alert alert-danger hidden"></div>
					</div>
					<div class="form-group">
						<label for="category_id_id" class="form-control-label">Nom global de la categorie</label>
						<select name="category_id_id" id="category_id_id" class="form-control form-control-sm">
							<option value="">Choisissez le nom</option>
							@foreach($categories as $category)
							<option value="{{ $category->id }}">{{ $category->namecategory }}</option>
							@endforeach
						</select>
						<div class="alert alert-danger hidden"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="Reset" class="btn btn-secondary btn-sm">Annuler</button>
					<button type="button" id="id-form"
						class="btn btn-primary btn-sm crud-modal-category-form">Cr&eacute;er</button>
				</div>
			</form>
		</div>
	</div>
</div>