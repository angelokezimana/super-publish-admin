 <!-- Debut  formulaire -->
 <div class="modal fade" id="formulaire">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg_teal">
             <h5 class="modal-title" id="crud-modal-category-label">Ajouter  cat&eacute;gorie</h5>         
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body row">
          <form>
                <input type="hidden" name="category_id" id="category_id">
                <div class="modal-body">
                    <div class="hidden alert alert-success"></div>
                    <div class="form-group">
                        <label for="namecategory" class="form-control-label">Nom de la cat&eacute;gorie</label>
                        <input type="text" id="namecategory" name="namecategory"
                            placeholder="Entrer le nom de la cat&eacute;gorie (ex. sport, actualite, ...)"
                            class="form-control form-control-sm">
                        <div class="alert alert-danger hidden"></div>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="Reset" class="btn btn-secondary btn-sm">Annuler</button>
                    <button type="button" id="id-form" class="btn-primary btn-sm crud-modal-category-form">Cr&eacute;er</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>

